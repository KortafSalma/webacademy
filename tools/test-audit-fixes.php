<?php
/** Regression probes roll back all persistence writes. */
declare(strict_types=1);
require dirname(__DIR__) . '/src/bootstrap.php';
use App\Core\{Api, Content, Database, Repos};
function check(bool $ok, string $name): void { if (!$ok) throw new RuntimeException($name); echo "PASS $name\n"; }
$db = Database::pdo();
$db->beginTransaction();
try {
    Repos::setSetting('__repair_null', null);
    check(Repos::setting('__repair_null', 'fallback') === null, 'JSON null round trip');
    $theme = Repos::setting('theme', 'dark');
    $r = Api::handle('settings-save', 'POST', ['theme' => $theme === 'dark' ? 'light' : 'dark', 'langMode' => 'invalid']);
    check(($r['status'] ?? 0) === 422 && Repos::setting('theme', 'dark') === $theme, 'invalid settings do not partially write');
    $r = Api::handle('settings-save', 'POST', ['lastLesson' => null]);
    check($r['ok'] && $r['lastLesson'] === null, 'clear lastLesson');
    $missing = (int) $db->query('SELECT COALESCE(MAX(id), 0) + 100000 FROM notes')->fetchColumn();
    $r = Api::handle('note-save', 'POST', ['id' => $missing, 'body' => 'regression']);
    check(($r['status'] ?? 0) === 404, 'missing note returns 404');
    $id = Repos::saveNote(0, 'regression', 'body', null);
    check(Repos::saveNote($id, 'regression', 'body', null) === $id, 'unchanged existing note still saves');
} finally { $db->rollBack(); }
$count = 0;
foreach (Content::manifest()['modules'] as $m) foreach ($m['chapters'] as $ch) {
    check(Content::lesson($m['id'], (int) $ch['n']) !== null, $m['id'] . '-' . $ch['n']); $count++;
}
check(count(Content::projects()) === 6, 'six projects discovered');
echo "$count lessons loaded.\n";
