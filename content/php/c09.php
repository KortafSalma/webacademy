<?php

declare(strict_types=1);

/**
 * MODULE PHP — Chapitre 9 : Traitement des formulaires
 * $_GET, $_POST, $_REQUEST, $_SERVER, isset()/empty(), trim,
 * htmlspecialchars (anti-XSS), filter_var (validation).
 */

return [
    'id'       => 'php-ch9',
    'title'    => 'Traitement des formulaires',
    'subtitle' => 'Comment les données saisies par le visiteur arrivent dans votre PHP ?',

    'objectives' => [
        'Comprendre comment un formulaire HTML envoie ses données au serveur.',
        'Choisir entre $_GET et $_POST (et connaître $_REQUEST).',
        'Distinguer isset() et empty() pour tester les saisies.',
        'Nettoyer avec trim() et protéger l\'affichage avec htmlspecialchars() (anti-XSS).',
        'Valider une adresse e-mail avec filter_var() et FILTER_VALIDATE_EMAIL.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'le-voyage-des-donnees',
            'title' => 'Le voyage des données : du navigateur au serveur',
            'icon'  => '📮',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Un <strong>formulaire</strong> permet à l\'utilisateur d\'envoyer des données au serveur : champs de texte, mots de passe, cases à cocher… En HTML, la balise <code>&lt;form&gt;</code> précise <strong>où</strong> envoyer (attribut <code>action</code>) et <strong>comment</strong> envoyer (attribut <code>method</code>). Chaque champ porte un <strong>attribut <code>name</code></strong> : c\'est grâce à ce nom que PHP retrouvera la valeur. Un champ <em>sans</em> <code>name</code> n\'arrive jamais au serveur.</p>',
                 'darija' => '<p>Formulaire katkhelli l\'utilisateur yseft des données l serveur : champs, password, checkboxes… F HTML, <code>&lt;form&gt;</code> 3andha jouj attributs mohimmin : <code>action</code> (fin namchiw) w <code>method</code> (kifach namchiw). Kol champ khasou ykoun 3andou <code>name</code> : b had name PHP kaylqa la valeur. Ila nsiti <code>name</code>, la valeur ma katousel 3mmer l PHP.</p>'],

                ['type' => 'syntax',
                 'lang' => 'html',
                 'title' => 'Un formulaire d\'inscription minimal',
                 'code' => <<<'HTML'
<form action="traitement.php" method="post">
  <label>Nom : <input type="text" name="nom"></label>
  <label>E-mail : <input type="email" name="email"></label>
  <button type="submit">Envoyer</button>
</form>
HTML,
                ],

                ['type' => 'text',
                 'fr'   => '<p>Quand l\'utilisateur clique sur <em>Envoyer</em>, le navigateur envoie une requête HTTP vers <code>traitement.php</code>. PHP place alors <strong>toutes les données du formulaire dans des superglobales</strong> : des tableaux spéciaux, disponibles partout dans votre code.</p><ul><li><code>$_GET</code> : les données passées dans l\'<strong>URL</strong> (après le <code>?</code>) ou avec <code>method="get"</code> ;</li><li><code>$_POST</code> : les données envoyées avec <code>method="post"</code>, invisibles dans l\'URL ;</li><li><code>$_REQUEST</code> : le mélange GET + POST + COOKIE, déconseillé aussi.</li></ul>',
                 'darija' => '<p>Mnin l\'utilisateur kayclicki 3la <em>Envoyer</em>, le navigateur kayseft requête HTTP l <code>traitement.php</code>. PHP kayjme3 kol les données dyal formulaire f des <strong>superglobales</strong> : des tableaux kbira kaynajmo tkhdmo f kol blasa f code dyalek. <code>$_GET</code> fiha data lli lli f l\'URL, <code>$_POST</code> fiha data dyal method="post" (makhbayach f l\'URL), w <code>$_REQUEST</code> khllta binathom — mafianich tkhdem biha.</p>'],

                ['type' => 'table',
                 'headers' => ['Critère', '$_GET', '$_POST'],
                 'rows' => [
                    ['La valeur passe', 'Dans l\'URL (?nom=Alaoui)', 'Dans le corps de la requête HTTP'],
                    ['Visible par l\'utilisateur', 'Oui, dans la barre d\'adresse', 'Non'],
                    ['Taille', 'Limitée (URL courte)', 'Bien plus grande (config serveur)'],
                    ['Peut envoyer un fichier', 'Non', 'Oui (multipart/form-data)'],
                    ['Usage typique', 'Recherche, filtre, lien partageable', 'Login, inscription, données sensibles'],
                 ],
                 'fr' => 'Règle simple : <code>$_GET</code> pour ce qui est <em>demandé</em> (lecture), <code>$_POST</code> pour ce qui est <em>envoyé</em> (inscription, mot de passe).'],

                ['type' => 'definition', 'title' => '$_REQUEST et $_SERVER',
                 'fr'   => '<p><code>$_REQUEST</code> fusionne <code>$_GET</code> + <code>$_POST</code> + <code>$_COOKIE</code> : pratique d\'apparence, dangereuse en pratique — impossible de savoir d\'où vient la valeur, et l\'ordre de fusion dépend de la configuration du serveur. Préférez <code>$_GET</code> ou <code>$_POST</code> explicitement.</p><p><code>$_SERVER[\'REQUEST_METHOD\']</code> contient la méthode de la requête : <code>"GET"</code> si la page est simplement ouverte, <code>"POST"</code> si le formulaire a été soumis. C\'est le test classique pour savoir si un formulaire vient d\'être envoyé.</p>',
                 'darija' => '<p><code>$_REQUEST</code> katjme3 GET + POST + COOKIE f tableau wa7d : f zarba, walakin machi nochtal tkhdem biha hit ma3erfinch men fin jat la valeur. Khtare7 <code>$_GET</code> wla <code>$_POST</code> b serbi7a. W <code>$_SERVER[\'REQUEST_METHOD\']</code> katgl lik la méthode : "GET" ila fett\'i la page 3adia, "POST" ila soumiti formulaire.</p>'],

                ['type' => 'example',
                 'title' => 'traitement.php — le vrai code côté serveur',
                 'lang' => 'php',
                 'code' => <<<'PHP'
<?php
// On ne traite que la soumission POST du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ?? '' évite le warning si la clé est absente
    $nom = trim($_POST['nom'] ?? '');

    if ($nom === '') {
        echo 'Nom obligatoire !';
    } else {
        echo 'Bonjour ' . htmlspecialchars($nom);
    }
}
?>
PHP,
                 'output' => 'Bonjour Rachid',
                 'explainFr' => 'Le visiteur a rempli le champ « nom » avec Rachid puis soumis en POST. PHP vérifie la méthode, récupère <code>$_POST[\'nom\']</code>, nettoie puis affiche. Sans le test REQUEST_METHOD, le message s\'afficherait aussi à la première visite, quand $_POST est encore vide.',
                 'explainDarija' => 'L\'utilisateur 3mmer champ "nom" b Rachid w soumiti b POST. PHP kaychof la méthode, kayjib <code>$_POST[\'nom\']</code>, kaysed9ih b trim, w kayaffichi. Bla verification dyal REQUEST_METHOD, message ghadi iban tani f awl marra dkhelti l page mnin kan $_POST khawya.',
                ],

                ['type' => 'note',
                 'title' => 'Honnêteté du labo : $_GET est impossible en CLI',
                 'fr'   => 'Les superglobales <code>$_GET</code> / <code>$_POST</code> ne se remplissent que lorsqu\'une <strong>vraie requête HTTP</strong> arrive, c\'est-à-dire quand votre fichier tourne derrière un serveur web (Apache, XAMPP, php -S). Dans le labo, le code s\'exécute en <strong>ligne de commande (CLI)</strong> : aucune requête n\'arrive, donc <code>$_GET[\'nom\']</code> y resterait vide. <strong>Ce chapitre ne ment pas</strong> : le code de formulaire doit être lu comme du code de production, à tester plus tard avec un vrai serveur. Dans les exercices CLI, on utilise un <strong>tableau de données simulé</strong> , et on teste la présence des clés avec <code>array_key_exists()</code>.',
                 'darija' => 'Nqolha b sarfa7a : <code>$_GET</code> w <code>$_POST</code> matmélihomch 3mmer ktatégoli koll la requête HTTP dd79a, ya3ni mnin fichi khedem steroid b serveur web (Apache, XAMPP, php -S). F labo, le code kaykhaddami b CLI : ma fih la verre requête, donc <code>$_GET</code> khawya dy9al f tabula. Had CH khdm3na m3ak bach tssyaa kifachi ykhdmo formulaires f l\'internet. F les exercices dyal labo, nstakhdmo tableau dyal données simulées, w ntesti les clés b <code>array_key_exists()</code>.',
                ],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'isset-empty',
            'title' => 'isset() / empty() : tester une saisie sans warning',
            'icon'  => '🔍',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Problème fréquent : le visiteur ouvre la page <em>sans</em> soumettre le formulaire, donc <code>$_POST[\'nom\']</code> n\'existe pas encore. Lire une clé inexistante déclenche un <code>Warning</code>. Deux fonctions permettent de tester avant d\'utiliser :</p><ul><li><strong><code>isset($x)</code></strong> → true si $x existe <em>et</em> n\'est pas <code>null</code> ;</li><li><strong><code>empty($x)</code></strong> → true si $x est « vide » : <code>""</code>, <code>"0"</code>, <code>0</code>, <code>null</code>, <code>false</code>, tableau vide… ou si $x n\'existe pas.</li></ul>',
                 'darija' => '<p>Mochkil mte3em : l\'utilisateur kayfett la page bla ma soumiti formulaire, donc <code>$_POST[\'nom\']</code> makaynach. Ila qriti clé makaynach kayti9 3andek <code>Warning</code>. 3andek jouj fonctions bach ttesti qbel ma tkhdem : <code>isset($x)</code> katrji3 true ila $x kayna w makaynach b <code>null</code>. <code>empty($x)</code> katrji3 true ila $x khawya : "" , "0", 0, false, tableau khawya… wla makaynatch.</p>'],

                ['type' => 'table',
                 'headers' => ['Valeur de $x', 'isset($x)', 'empty($x)'],
                 'rows' => [
                    ['"Rachid"', 'true', 'false'],
                    ['"" (chaîne vide)', 'true', 'true'],
                    ['0 (zéro)', 'true', 'true'],
                    ['false', 'true', 'true'],
                    ['null', 'false', 'true'],
                    ['clé jamais déclarée', 'false', 'true'],
                 ],
                 'fr' => 'Grande différence : isset() répond seulement à « est-ce que ça existe (non null) ? », alors que empty() juge le <em>contenu</em> « vide ou pas » selon une liste de valeurs falsy.',
                ],

                ['type' => 'warning',
                 'title' => 'Le piège du zéro',
                 'fr'   => 'Note d\'examen = 0 : <code>isset($note)</code> vaut true (la clé existe) mais <code>empty($note)</code> vaut <strong>true aussi</strong>, car 0 est considéré « vide ». Un test « si empty alors pas de note » effacerait les vraies notes égales à zéro. Pour vérifier qu\'une clé existe : <code>isset()</code> ou <code>array_key_exists()</code>. Pour vérifier qu\'un texte n\'est pas que des espaces : <code>trim($x) === \'\'</code>.',
                 'darija' => 'Hadi mohimma b zaf ! Note = 0 : isset() katgol true w empty() tani katgol true (7it 0 t3tabber khawya). Ila drti la logique dyalek 3la empty(), ghaliban note=0 ghadi tban "makaynach". Existence = isset() wla array_key_exists(). Texte fih ghir espaces = trim($x) === \'\'.',
                ],

                ['type' => 'example',
                 'title' => 'isset vs empty — exécutable en CLI',
                 'lang' => 'php',
                 'code' => <<<'PHP'
<?php
$d = ['nom' => 'Rachid', 'note' => 0, 'vide' => ''];

var_dump(isset($d['nom']));    // clé présente
var_dump(isset($d['email']));  // clé absente
var_dump(empty($d['email']));  // absente => empty renvoie true
var_dump(empty($d['note']));   // 0 existe mais est "vide" pour empty
?>
PHP,
                 'output' => 'bool(true)
bool(false)
bool(true)
bool(true)',
                 'explainFr' => '<code>isset($d[\'email\'])</code> vaut false simplement parce que la clé est absente — sans erreur ni warning. Et <code>empty($d[\'note\'])</code> vaut true alors que la note existe bien : 0 est compté comme vide. D\'où la méthode : d\'abord « la clé existe ? » (isset), puis « le contenu est propre ? » (trim).',
                 'explainDarija' => 'isset 3nd clé makaynach katrji3 false bla warning. W empty() t3tabber 0 khawya walakin note kayna f tableau. Hadi hiya l\'far9 : isset katgol "wach kayna ?" w empty katgol "wach khawya ?".',
                ],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'nettoyage-validation',
            'title' => 'Nettoyer puis valider : trim, htmlspecialchars, filter_var',
            'icon'  => '🧼',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Les saisies humaines sont rarement propres : espaces en trop, HTML malveillant, e-mails fantaisistes. Trois réflexes d\'or, dans cet ordre :</p><ol><li><strong>Nettoyer</strong> : <code>trim($texte)</code> supprime espaces, tabulations et retours à la ligne <em>au début et à la fin</em> (jamais au milieu).</li><li><strong>Valider</strong> : <code>filter_var($v, FILTER_VALIDATE_EMAIL)</code> renvoie l\'e-mail si le format est correct, <code>false</code> sinon (même logique pour l\'entier avec <code>FILTER_VALIDATE_INT</code>).</li><li><strong>Échapper à la sortie</strong> : <code>htmlspecialchars($texte, ENT_QUOTES)</code> transforme <code>&lt;</code> <code>&gt;</code> <code>&amp;</code> <code>"</code> <code>\'</code> en entités HTML <em>juste avant l\'<code>echo</code></em>. C\'est le rempart contre la faille <strong>XSS</strong>.</li></ol>',
                 'darija' => '<p>Data dyal l\'utilisateur 3ndha finto : espaces zayda, HTML khater, emails ghalat. 3andek tlata reflexes dhabiya b had tertib : 1) <strong>Nettoyer</strong> b <code>trim()</code> — kayhyed les espaces mn lowel w lekher. 2) <strong>Valider</strong> b <code>filter_var(..., FILTER_VALIDATE_EMAIL)</code> — kayrje3 l\'email ila s7i7, false ila la. 3) <strong>Escaper f la sortie</strong> b <code>htmlspecialchars(..., ENT_QUOTES)</code> — katbeddel &lt; &gt; w \" b entités HTML qbel kol <code>echo</code> ; hadi li katbess execution men had l\'attaque smittha <strong>XSS</strong>.</p>'],

                ['type' => 'warning',
                 'title' => 'Pourquoi htmlspecialchars est OBLIGATOIRE avant echo (faille XSS)',
                 'fr'   => 'Imaginez un livre d\'or : le visiteur écrit un commentaire, vous le stockez puis l\'affichez à tout le monde. Si un pirate place <code>&lt;script&gt;…&lt;/script&gt;</code> dans son commentaire et que vous faites <code>echo $commentaire;</code> tel quel, chaque visiteur exécutera ce script <strong>dans son propre navigateur</strong> : vol de session, faux formulaire de connexion… C\'est la faille <strong>XSS (Cross-Site Scripting)</strong>. Avec <code>htmlspecialchars()</code>, <code>&lt;script&gt;</code> devient le <em>texte</em> <code>&amp;lt;script&amp;gt;</code> affiché à l\'écran, jamais exécuté. Règle d\'or : échapper <strong>à la sortie</strong>, à chaque <code>echo</code> de données externes.',
                 'darija' => 'Kheyyel "livre d\'or" : koll visiteur kaykteb commentaire w nta kat-affichi 3lihe l kulchi. Hacker ykteb <code>&lt;script&gt;…&lt;/script&gt;</code> f commentaire dyalou, w ile nta drti <code>echo $commentaire;</code> nichan, koll visiteur ghadi isafer had script f navigateur dyalou (yser9 la session, ydir formulaire fake…). Hadi hiya faille <strong>XSS</strong>. b <code>htmlspecialchars()</code>, le script kayweli texte yban f l\'ecran w makayssirech lih. Tanta : escaper <strong>waqt l\'affichage</strong>, f koll echo dyal data khariya.',
                ],

                ['type' => 'example',
                 'title' => 'Le script neutralisé par htmlspecialchars',
                 'lang' => 'php',
                 'code' => <<<'PHP'
<?php
$commentaire = '<script>alert("coucou");</script>';

// DANGEREUX : jamais ca sur un vrai site !
// echo $commentaire;

// SÛR : le script devient du texte inoffensif
echo htmlspecialchars($commentaire, ENT_QUOTES, 'UTF-8');
?>
PHP,
                 'output' => '&lt;script&gt;alert(&quot;coucou&quot;);&lt;/script&gt;',
                 'explainFr' => 'Le <code>&lt;</code> est devenu <code>&amp;lt;</code>, le <code>&gt;</code> devient <code>&amp;gt;</code> et le <code>"</code> devient <code>&amp;quot;</code> (ENT_QUOTES échappe aussi les apostrophes). Le navigateur n\'a donc plus de balise à interpréter : il affiche le code comme du simple texte.',
                 'explainDarija' => '<code>&lt;</code> wellat <code>&amp;lt;</code>, <code>&gt;</code> wellat <code>&amp;gt;</code>, w \" wellat <code>&amp;quot;</code> (ENT_QUOTES kayescaper tani les apostrophes). Le navigateur ma3adech kaylqa balises bach yt-mmhez, kayaffichi kolchi kma texte 3adi : XSS mach bach tnajem.',
                ],

                ['type' => 'example',
                 'title' => 'trim + filter_var : nettoyer puis valider un e-mail',
                 'lang' => 'php',
                 'code' => <<<'PHP'
<?php
$saisie = "   Salma@EMSI.ma   ";
$email = trim($saisie);   // on enlève les espaces des bords

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Adresse valide : ' . $email;
} else {
    echo 'Adresse invalide';
}
?>
PHP,
                 'output' => 'Adresse valide : Salma@EMSI.ma',
                 'explainFr' => 'D\'abord trim() retire les espaces, ensuite filter_var() contrôle le format. Si la saisie avait été « salma@@site », filter_var aurait renvoyé false et on afficherait « Adresse invalide ». Remarquez qu\'on valide le format, pas l\'existence de la boîte : seule une confirmation par e-mail peut prouver que le compte est réel.',
                 'explainDarija' => 'Awwelan trim() kaysded espaces zayda, mn ba3d filter_var() kaytesti format. Ila kanet "salma@@site", filter_var kayrje3 false w ban "Adresse invalide". W nit : hna kanverifiw ghir format, machi wach l\'email kayen 7aqi9iyane — dak chi kan-salih bih email de confirmation.',
                ],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'echo ($_GET[\'nom\']);',
            'fix'    => '$nom = trim($_GET[\'nom\'] ?? \'\'); echo htmlspecialchars($nom, ENT_QUOTES);',
            'fr'     => 'Lire $_GET directement n\'est pas sûr : clé absente → warning ; contenu sauvage affiché sans échappement → faille XSS.',
            'darija' => 'Ila qriti $_GET nichan : ila clé makaynach kayti9 warning, w ila kan fih code khayeb kat-affichih nichan — XSS. Dimma ?? \'\' w htmlspecialchars.',
        ],
        [
            'wrong'  => 'if (empty($note)) { /* pas de note */ }',
            'fix'    => 'if (!isset($note) || trim((string)$note) === \'\') { /* pas de note */ }',
            'fr'     => 'empty() considère 0 comme vide : une note de 0 serait jugée « absente ». Réservez empty() aux vérifications rapides et testez le contenu avec trim.',
            'darija' => 'empty() kat3tabber 0 khawya : note=0 ghadi tban "makaynach". Khdem b isset() wla trim() bach ttesti contenu b sarbi7a.',
        ],
        [
            'wrong'  => 'Champ de formulaire sans attribut name ; login envoyé en method="get"',
            'fix'    => 'name obligatoire sur chaque champ ; method="post" pour les données sensibles.',
            'fr'     => 'Un champ sans <code>name</code> n\'arrive jamais dans $_POST. Un mot de passe envoyé en GET apparaîtrait en clair dans l\'URL et l\'historique du navigateur.',
            'darija' => 'Champ bla <code>name</code> ma katousel 3mmer l PHP. W password b GET kayban f l\'URL w f l\'historique dyal navigateur — dimma POST l les données sensibles.',
        ],
        [
            'wrong'  => 'Utiliser $_REQUEST pour son formulaire de connexion',
            'fix'    => 'Utiliser $_POST explicitement',
            'fr'     => '$_REQUEST mélange GET, POST et COOKIE : vous ne savez plus d\'où vient la donnée, ce qui ouvre des failles subtiles.',
            'darija' => '$_REQUEST katkhelt GET + POST + COOKIE : mat3erfinch men fin jat la valeur. Khtara mola tkhedem biha — direkten khtar $_POST.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>Un formulaire HTML</b> envoie ses champs (attribut <code>name</code>) dans <b>$_GET</b> (URL) ou <b>$_POST</b> (corps de requête) ; <b>$_SERVER[\'REQUEST_METHOD\']</b> révèle la méthode utilisée et <b>$_REQUEST</b> fusionne tout (à éviter). Avant d\'utiliser une saisie : <b>isset()</b> / <b>trim()</b> pour tester et nettoyer, <b>filter_var()</b> pour valider, puis <b>htmlspecialchars()</b> à chaque <code>echo</code> pour bloquer le <b>XSS</b>. En CLI, <code>$_POST</code> reste vide : les exercices simulent les données avec des tableaux et <code>array_key_exists()</code>.',
        'darija' => '<b>Formulaire</b> kayseft les champs (b <code>name</code>) l <b>$_GET</b> (f l\'URL) wla <b>$_POST</b> (makhfiya). Qbel ma tkhdem b data : <b>isset()</b> w <b>trim()</b> bach ttesti w tneddi, <b>filter_var()</b> bach tverifi, w <b>htmlspecialchars()</b> f koll <code>echo</code> bach tbess XSS. F labo CLI, <code>$_POST</code> khawya : f les exercices kan-simulaw data b tableaux w <code>array_key_exists()</code>.',
    ],
];

