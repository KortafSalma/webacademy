"""Run the examples and JavaScript assertions of the eight added chapters.

Requires PHP, Node and g++ on PATH. Uses temporary files and in-memory SQLite.
"""
import json
import os
from pathlib import Path
import shutil
import subprocess
import tempfile

ROOT = Path(__file__).resolve().parent.parent
os.chdir(ROOT)


def run(args, input=None):
    return subprocess.run(args, input=input, capture_output=True, text=True,
                          encoding='utf-8', errors='strict', check=True, timeout=30).stdout


def content(module, kind, chapter):
    return json.loads(run(['php', '-r', f'echo json_encode(require "content/{module}/{kind}{chapter:02}.php");']))


def normalize(value):
    return ' '.join(value.split())


def main():
    compiler = shutil.which('g++')
    if not compiler:
        raise RuntimeError('g++ is required to verify C++ examples.')
    checks = 0
    subjects = [('javascript', 31), ('javascript', 32), ('cpp', 31), ('cpp', 32),
                ('php', 16), ('php', 17), ('sql', 15), ('sql', 16)]
    with tempfile.TemporaryDirectory(prefix='webacademy-lessons-') as directory:
        for module, chapter in subjects:
            lesson = content(module, 'c', chapter)
            exercises = content(module, 'ex', chapter)
            examples = [(block['code'], block['output']) for section in lesson['lessons']
                        for block in section['blocks'] if block['type'] == 'example']
            if module == 'cpp':
                for level in exercises['levels']:
                    expected = level['explainFr'].split('Résultat attendu : ', 1)[1].split('. ', 1)[0]
                    examples.append((level['solution'], expected))
            for index, (code, expected) in enumerate(examples):
                if module == 'cpp':
                    source = Path(directory) / f'lesson-{chapter}-{index}.cpp'
                    binary = source.with_suffix('.exe' if os.name == 'nt' else '.out')
                    source.write_text(code, encoding='utf-8')
                    run([compiler, '-std=c++17', '-Wall', '-Wextra', '-pedantic', str(source), '-o', str(binary)])
                    actual = run([str(binary)])
                elif module == 'javascript':
                    actual = run(['node', '-e', code])
                elif module == 'php':
                    actual = run(['php'], input=code)
                else:
                    rows = json.loads(run(['php', '-r', '$db = new PDO("sqlite::memory:"); '
                                           'echo json_encode($db->query(stream_get_contents(STDIN))->fetchAll(PDO::FETCH_NUM));'], input=code))
                    actual = '\n'.join(' | '.join(str(cell) for cell in row) for row in rows)
                assert normalize(actual) == normalize(expected), (module, chapter, expected, actual)
                checks += 1
            if module == 'javascript':
                for level in exercises['levels']:
                    assertions = '\n'.join('if (!(' + test['value'] + ')) throw new Error("Exercise assertion failed");'
                                           for test in level['tests'])
                    run(['node', '-e', level['solution'] + '\n' + assertions])
                    checks += len(level['tests'])
            print(f'PASS {module} chapter {chapter}')
    print(f'{checks} executable examples and assertions passed.')


if __name__ == '__main__':
    main()
