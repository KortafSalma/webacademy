<?php

declare(strict_types=1);

/**
 * MODULE HTML — Chapitre 7 : Formulaires
 * Format identique à content/html/c01.php.
 */

return [
    'id'       => 'html-ch7',
    'title'    => 'Formulaires',
    'subtitle' => 'Collecter des données de l\'utilisateur : form, inputs, select, boutons — la porte d\'entrée vers PHP.',

    'objectives' => [
        'Construire un formulaire avec <code>form</code> et comprendre <code>action</code> et <code>method</code>.',
        'Choisir le bon <code>type</code> d\'<code>input</code> et différer GET de POST.',
        'Associer un <code>label</code> à son champ avec <code>for</code>, et donner un <code>name</code> à chaque champ.',
        'Utiliser <code>textarea</code>, <code>select</code>, les boutons et <code>fieldset</code>.',
        'Gérer l\'envoi de fichiers avec <code>enctype</code>.',
        'Assembler un formulaire d\'inscription complet.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'form-base',
            'title' => 'Le conteneur form : action et method',
            'icon'  => '📮',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Un <strong>formulaire</strong> est une zone de la page où l\'utilisateur <em>saisit</em> des données que le site va <em>recevoir</em> : login, recherche, inscription, commande… Tout le formulaire vit à l\'intérieur de la balise <code>&lt;form&gt;</code>, qui possède deux attributs essentiels :</p><ul><li><code>action</code> : l\'<strong>URL où les données seront envoyées</strong> (un fichier PHP le plus souvent) ;</li><li><code>method</code> : <strong>comment</strong> elles seront envoyées — <code>get</code> ou <code>post</code>.</li></ul>',
                 'darija' => '<p>Formulaire hiya la partie dyal la page fin l\'utilisateur kaykteb data li le site ghadi yakhodha : login, recherche, inscription… Kolchi kaykoun daxel <code>&lt;form&gt;</code>. form 3andou jouj attributs mohimmin : <code>action</code> hiya l\'URL li ghadi tseft liha data (souvent fichier PHP), w <code>method</code> hiya kifach ghadi tseft — <code>get</code> ola <code>post</code>.</p>'],

                ['type' => 'table',
                 'headers' => ['Critère', 'method="get"', 'method="post"'],
                 'rows' => [
                    ['Les données partent', 'Dans l\'URL, visibles après un ?', 'Dans le corps de la requête HTTP, invisibles dans l\'URL'],
                    ['Limite de taille', 'Courte : l\'URL est limitée (~2000 caractères)', 'Aucune limite pratique'],
                    ['Rafraîchir / partager l\'URL', 'La URL avec données reste partageable', 'Impossible : la page se perd'],
                    ['Idéal pour', 'Recherche, filtres, navigation', 'Login, inscription, envoi de fichier, modification de données'],
                    ['PHP côté serveur', 'Tableau $_GET', 'Tableau $_POST'],
                 ],
                 'fr' => 'Règle simple : <b>get</b> pour lire/filtrer (l\'URL se partage), <b>post</b> pour tout ce qui écrit ou est sensible (mots de passe, fichiers, paiements).'],

                ['type' => 'example',
                 'title' => 'Mini-formulaire de recherche (GET)',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Recherche</title>
</head>
<body>
  <h1>Rechercher un cours</h1>
  <form action="recherche.php" method="get">
    <label for="q">Mot-clé :</label>
    <input type="text" id="q" name="q" placeholder="ex : PHP">
    <button type="submit">Rechercher</button>
  </form>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'À la validation, le navigateur va vers <code>recherche.php?q=PHP</code> : le champ <code>name="q"</code> et sa valeur sont accrochés à l\'URL. Le fichier PHP (module PHP, chapitre 9) lira cette valeur dans le tableau <code>$_GET[\'q\']</code>.',
                 'explainDarija' => 'Mnin l\'utilisateur ykliki 3la Rechercher, navigateur ymchi l <code>recherche.php?q=PHP</code> : smiya dyal champ (<code>name</code>) w valeur dyalo tziddo f URL. F module smitou PHP ghadi n3arko b had data: $_GET[\'q\'].'],

                ['type' => 'tip',
                 'title' => 'name : sans lui, PHP ne reçoit RIEN',
                 'fr'   => 'Chaque champ envoyé au serveur doit avoir un attribut <code>name</code>. C\'est <em>la clé</em> utilisée dans <code>$_GET</code> / <code>$_POST</code> côté PHP. Un champ sans <code>name</code> est purement décoratif.',
                 'darija' => 'Diman ketb <code>name</code> f kol champ. hadi hiya l\'clé li PHP kaychouf fiha dak champ f $_GET ola $_POST. Ila ma ktbha ma katseft walou.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'inputs',
            'title' => 'Les input et leurs types',
            'icon'  => '⌨️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>La balise <code>&lt;input&gt;</code> est une balise <strong>orpheline</strong> (sans balise fermante) qui change complètement de comportement selon son attribut <code>type</code>. C\'est l\'élément le plus polyvalent du HTML.</p>',
                 'darija' => '<p><code>&lt;input&gt;</code> balise wa7da b-la fermeture, walakin kaytbeddel complètement selon <code>type</code> dyalha : ktb 3adi, mot de passe, email, date… hadi hiya la balise li kayn akter les types fihom f HTML.</p>'],

                ['type' => 'table',
                 'headers' => ['type', 'Ce que ça donne', 'Exemple d\'usage'],
                 'rows' => [
                    ['text', 'Champ de texte simple sur une ligne', 'Nom, ville, recherche'],
                    ['password', 'Texte masqué par des points', 'Mot de passe'],
                    ['email', 'Vérifie le format x@y.z au clavier mobile', 'Adresse e-mail'],
                    ['number', 'Nombres uniquement, flèches +/−', 'Âge, quantité'],
                    ['date', 'Sélecteur de date du navigateur', 'Date de naissance'],
                    ['radio', 'Un seul choix dans un groupe (même name)', 'Sexe, paiement : CB / virement'],
                    ['checkbox', 'Plusieurs choix indépendants', 'Langues parlées, CGU'],
                    ['range', 'Curseur sur une plage min–max', 'Niveau de satisfaction'],
                    ['hidden', 'Valeur invisible envoyée quand même', 'Id de l\'article, jeton de sécurité'],
                 ],
                 'fr' => 'Utilisez toujours le type le plus spécifique : <code>email</code> bloque le formulaire si l\'adresse est invalide, <code>number</code> fait apparaître le clavier numérique sur mobile.'],

                ['type' => 'definition', 'title' => 'label + for : le champ porte un nom',
                 'fr'   => '<p>Le <code>&lt;label&gt;</code> est l\'étiquette du champ. On le relie à l\'input avec <code>for="id-du-champ"</code> (l\'input doit avoir le même <code>id</code>). Avantage : cliquer sur le texte active le champ, et le lecteur d\'écran annonce « Adresse e-mail » avant la saisie. Un <code>radio</code>/<code>checkbox</code> sans label est presque impossible à cocher proprement.</p>',
                 'darija' => '<p><code>&lt;label&gt;</code> howa le libellé dyal champ. Ktweslo m3a l\'input b <code>for</code> li 3andou nefs valeur dyal <code>id</code> dyal l\'input. Mnin l\'utilisateur ykliki 3la texte, l\'input kaytftêwl, w lecteur d\'écran kayqra smiya dyalou. Sans label, les radio/checkbox s3ib tkawi.'],

                ['type' => 'example',
                 'title' => 'Input variés : les types les plus utiles',
                 'lang'  => 'html',
                 'code'  => '<form action="inscription.php" method="post">
  <label for="nom">Nom complet :</label>
  <input type="text" id="nom" name="nom" placeholder="Ex : Sara Amrani" required>

  <label for="pass">Mot de passe :</label>
  <input type="password" id="pass" name="pass" required>

  <label for="mail">E-mail :</label>
  <input type="email" id="mail" name="mail" required>

  <label for="age">Âge :</label>
  <input type="number" id="age" name="age" min="16" max="99" value="20">

  <label for="naiss">Date de naissance :</label>
  <input type="date" id="naiss" name="naiss">

  <label for="niv">Niveau en HTML :</label>
  <input type="range" id="niv" name="niveau" min="0" max="10" value="5">

  <input type="hidden" name="filiere" value="2SAD">
</form>',
                 'preview' => true,
                 'explainFr' => '<code>placeholder</code> : exemple grisé disparaissant à la saisie ; <code>required</code> : le navigateur refuse d\'envoyer si vide ; <code>value</code> : valeur par défaut ; <code>min/max</code> : bornes ; <code>hidden</code> : envoye <em>name=filiere=2SAD</em> sans être visible — pratique pour transmettre des informations internes.',
                 'explainDarija' => '<code>placeholder</code> : exemple gris kaymchi mnin bqda tkteb ; <code>required</code> : navigateur ma kaysiftch ila khawi ; <code>value</code> : valeur par défaut ; <code>min/max</code> : limites ; <code>hidden</code> : kayseft data khfya (filiere=2SAD) bla tham l\'utilisateur.'],

                ['type' => 'example',
                 'title' => 'Radio et checkbox : le rôle du name',
                 'lang'  => 'html',
                 'code'  => '<p>Niveau d\'étude (un seul choix — même name) :</p>
<label><input type="radio" name="niveau" value="bac"> Bac</label>
<label><input type="radio" name="niveau" value="bac2"> Bac+2</label>
<label><input type="radio" name="niveau" value="licence"> Licence</label>

<p>Langues (plusieurs choix — checkbox) :</p>
<label><input type="checkbox" name="langues[]" value="ar"> Arabe</label>
<label><input type="checkbox" name="langues[]" value="fr"> Français</label>
<label><input type="checkbox" name="langues[]" value="en"> Anglais</label>',
                 'preview' => true,
                 'explainFr' => 'Les <code>radio</code> partagent le même <code>name</code> : le navigateur n\'en autorise qu\'un coché (c\'est ainsi que le groupe fonctionne). Les <code>checkbox</code> sont indépendantes ; leur <code>name</code> se termine par <code>[]</code> pour que PHP les reçoive <em>comme un tableau</em> dans <code>$_POST[\'langues\']</code>.',
                 'explainDarija' => 'Les radio 3andhom nefs <code>name</code> : hadi hiya lekli f kol groupe, wa7d kolek bach ymchi wahida bark. Les checkbox kol wahida bo7dha ; zidna <code>[]</code> f name bach PHP yakodh kol rDO nmrbou3 f tableau wa7da $_POST[\'langues\'].'],

                ['type' => 'warning',
                 'title' => 'Les erreurs de radio/checkbox',
                 'fr'   => 'Trois pièges : (1) donner des <code>name</code> différents à des radio qui doivent être un groupe unique — l\'utilisateur en coche plusieurs ; (2) oublier l\'attribut <code>value</code> — PHP reçoit "on" à la place de la vraie valeur ; (3) placer l\'input radio hors du <code>label</code> — impossible de cliquer confortablement.',
                 'darija' => '3 okha : (1) radio dyal nefs groupe khassek nefs <code>name</code>, ila li diti 3andhom smiyat mkhtalfin kandstion kaytchdir/v evil kaykons fiha radio bzzaf ; (2) tnsa <code>value</code> : PHP ghadi yakhod "on" machi l\'valeur l\'7aqiqiyya ; (3) dir <code>&lt;label&gt;</code> 3edin l\'input bach l\'utilisateur yqder ykliki wyakha ywlé ngiï.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'select-textarea-buttons',
            'title' => 'textarea, select, boutons et fieldset',
            'icon'  => '🎛️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Trois familles complètent les inputs :</p><ul><li><code>&lt;textarea&gt;</code> : texte <strong>long</strong> et <strong>multiligne</strong> (messages, descriptions) — attention : elle <strong>se referme</strong>, la valeur par défaut se met <em>entre</em> les balises, jamais dans un attribut value ;</li><li><code>&lt;select&gt;</code> : liste déroulante d\'<code>&lt;option&gt;</code>, groupable avec <code>&lt;optgroup label="…"&gt;</code> ;</li><li><code>&lt;button&gt;</code> : 3 types — <code>submit</code> (envoie le formulaire), <code>reset</code> (vide les champs), <code>button</code> (ne fait rien de HTML, c\'est pour JavaScript).</li></ul><p><code>&lt;fieldset&gt;</code> encadre visuellement un groupe de champs, avec un titre donné par <code>&lt;legend&gt;</code>.</p>',
                 'darija' => '<p>3 familles lokhra : <code>&lt;textarea&gt;</code> dyal texte twil multiligne (message, description) — balise fiha 7digati, valeur par defaut katktb <em>bin</em> les balises machi f value. <code>&lt;select&gt;</code> liste déroulante fiha <code>&lt;option&gt;</code>, w t9der tglassthom b <code>&lt;optgroup&gt;</code>. <code>&lt;button&gt;</code> 3 types : submit kaysift le formulaire, reset kayf6 les champs, button walou (dyal JavaScript). <code>&lt;fieldset&gt;</code> katdwyr 3la groupe dyal champs w titre dyalo howa <code>&lt;legend&gt;</code>.</p>'],

                ['type' => 'example',
                 'title' => 'Message + liste déroulante + boutons',
                 'lang'  => 'html',
                 'code'  => '<form action="contact.php" method="post">
  <fieldset>
    <legend>Votre demande</legend>

    <label for="sujet">Sujet :</label>
    <select id="sujet" name="sujet">
      <optgroup label="Cours">
        <option value="html">HTML</option>
        <option value="php">PHP</option>
      </optgroup>
      <optgroup label="Administratif">
        <option value=" inscription">Inscription</option>
        <option value="emploi">Emploi du temps</option>
      </optgroup>
    </select>

    <label for="msg">Message :</label>
    <textarea id="msg" name="message" rows="5" cols="40">Écrivez ici…</textarea>

    <button type="submit">Envoyer</button>
    <button type="reset">Réinitialiser</button>
    <button type="button">Aperçu (JS)</button>
  </fieldset>
</form>',
                 'preview' => true,
                 'explainFr' => 'Le <code>value</code> de l\'<code>option</code> choisie est ce que reçoit PHP (<code>$_POST[\'sujet\']</code> vaut par exemple "php"). Le texte du <code>textarea</code> par défaut est écrit entre ses balises. Le bouton <code>type="button"</code> n\'envoie rien : sans code JavaScript derrière lui, il est inerte.',
                 'explainDarija' => '<code>value</code> dyal option li khtarou howa li kayjib PHP ($_POST[\'sujet\'] = "php"). Texte par defaut dyal textarea katkteb bin <code>&lt;textarea&gt;</code> w <code>&lt;/textarea&gt;</code>. Bouton dyal <code>type="button"</code> ma kaysift walou ydid — khassek JS bach ydir chi 7aja.'],
            ],
        ],

        // ------------------------------------------------ Section 4
        [
            'id'    => 'fichier-inscription',
            'title' => 'Envoyer un fichier, puis l\'inscription complète',
            'icon'  => '📎',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Pour déposer une image ou un CV, on utilise <code>&lt;input type="file"&gt;</code>, mais avec une condition : le formulaire doit passer en <code>method="post"</code> et déclarer <code>enctype="multipart/form-data"</code> sur <code>&lt;form&gt;</code>. Sans <code>enctype</code>, le fichier n\'est <strong>jamais</strong> transmis : seul son nom arrive au serveur.</p>',
                 'darija' => '<p>Bach tseft image ola CV, dir <code>&lt;input type="file"&gt;</code>, walakin lazem le formulaire ykoun <code>method="post"</code> w ykoun <code>enctype="multipart/form-data"</code> f <code>&lt;form&gt;</code>. Sans <code>enctype</code>, fichier maghadich ytsift — ghir smiya dyalo li kayousel.'],

                ['type' => 'example',
                 'title' => 'Formulaire d\'inscription COMPLET (à recopier)',
                 'lang'  => 'html',
                 'code'  => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
</head>
<body>
  <h1>Créer un compte étudiant</h1>
  <form action="traitement.php" method="post" enctype="multipart/form-data">

    <fieldset>
      <legend>Identité</legend>
      <label for="nom">Nom complet :</label>
      <input type="text" id="nom" name="nom" required>

      <label for="mail">E-mail :</label>
      <input type="email" id="mail" name="mail" required>

      <label for="pass">Mot de passe :</label>
      <input type="password" id="pass" name="pass" minlength="8" required>
    </fieldset>

    <fieldset>
      <legend>Profil</legend>
      <label for="fili">Filière :</label>
      <select id="fili" name="filiere">
        <option value="2SAD">2SAD</option>
        <option value="2IA">2IA</option>
        <option value="2GD">2GD</option>
      </select>

      <p>Sexe :</p>
      <label><input type="radio" name="sexe" value="F"> Féminin</label>
      <label><input type="radio" name="sexe" value="M"> Masculin</label>

      <p>Compétences :</p>
      <label><input type="checkbox" name="comp[]" value="html"> HTML</label>
      <label><input type="checkbox" name="comp[]" value="css"> CSS</label>
      <label><input type="checkbox" name="comp[]" value="php"> PHP</label>

      <label for="photo">Photo :</label>
      <input type="file" id="photo" name="photo" accept="image/*">
    </fieldset>

    <button type="submit">S\'inscrire</button>
  </form>
</body>
</html>',
                 'preview' => true,
                 'explainFr' => 'Ce formulaire réunit presque tout le chapitre : deux fieldset, champs obligatoires avec <code>required</code>, un <code>select</code>, un <code>radio</code>, des <code>checkbox</code> (avec <code>[]</code>), un fichier avec <code>enctype</code>. À la validation, tout part vers <code>traitement.php</code> en POST — et le traitement, c\'est du PHP : nous l\'apprenons dans le module PHP, chapitre 9.',
                 'explainDarija' => 'Had le formulaire fih presque kulchi dyal le chapitre : fieldset, required, select, radio, checkbox m3a <code>[]</code>, w fichier m3a <code>enctype</code>. Mnin l\'utilisateur ykliki « S\'inscrire », kolchi kaymchi l <code>traitement.php</code> b POST. Le traitement dyal had data : hadi PHP, ghadi nkhdmou3liha f module PHP, chapitre 9.'],

                ['type' => 'note',
                 'title' => 'Et après ? Le traitement en PHP',
                 'fr'   => 'HTML <em>collecte</em> les données ; il ne les <em>traite</em> pas. Le fichier pointé par <code>action</code> (ex. <code>traitement.php</code>) recevra tout dans les tableaux <code>$_POST</code>, <code>$_GET</code> et <code>$_FILES</code>. Ce sera le sujet du module PHP — chapitre 9 (Formulaires et validation).',
                 'darija' => 'HTML kayjm3 data, walakin ma kaytraitihach. Le fichier li mwssod b <code>action</code> ghadi yakhod kolchi f $_POST, $_GET w $_FILES. Hadi PHP — ghadi nt3lmo3liha f module PHP, chapitre 9.'],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => '<input type="text" placeholder="Nom"> (sans name)',
            'fix'    => 'Ajouter name="nom"',
            'fr'     => 'Sans attribut <code>name</code>, le champ n\'est jamais envoyé : PHP ne reçoit rien, même si l\'utilisateur a bien rempli. Le <code>placeholder</code> n\'est qu\'un texte d\'aide, pas une valeur.',
            'darija' => 'Ila nsit <code>name</code>, l\'input maghadich yseft lol. PHP mayl9ach walou, hta ila l\'utilisateur 3mmrou. placeholder ghir texte dyal aide — machi value.',
        ],
        [
            'wrong'  => '<label>Mot de passe :</label> <input type="password"> sans for/id',
            'fix'    => 'label for="pass" + input id="pass"',
            'fr'     => 'Un label non relié au champ ne clique pas dessus et n\'est pas lu comme étiquette par les lecteurs d\'écran. Toujours : <code>for</code> du label = <code>id</code> de l\'input.',
            'darija' => 'Label ma mrbotach b champ (for = id) ma kayklikihach, w lecteur d\'écran ma kayqrahach bhal étiquette. Dima : for dyal label = id dyal input.',
        ],
        [
            'wrong'  => '<form method="get"> pour un mot de passe ou un fichier',
            'fix'    => 'method="post" (+ enctype pour les fichiers)',
            'fr'     => 'En GET, le mot de passe apparaît en clair dans l\'URL… et les historiques ! Et un fichier ne peut pas du tout partir en GET. Données sensibles ou fichiers : toujours POST, avec <code>enctype="multipart/form-data"</code> s\'il y a un fichier.',
            'darija' => 'B GET, le mot de passe kaytban f URL b kol letra — 7ta f historique dyal navigateur ! W fichier maghadich tseft b GET. Data dyal sensitive ola fichiers : dima POST, m3a <code>enctype</code> ila kayn fichier.',
        ],
        [
            'wrong'  => 'Radio ou checkbox sans attribut value',
            'fix'    => 'value="..." explicite sur chaque contrôle',
            'fr'     => 'Sans <code>value</code>, PHP reçoit la lettre "on" au lieu d\'une donnée utile : impossible de savoir ce que l\'utilisateur a coché. Chaque radio/checkbox doit porter sa propre <code>value</code>.',
            'darija' => 'Ila ma ktbti <code>value</code>, PHP ghadi yakhod ghir "on" machi data mfidat — ma tfhem chno khtar l\'utilisateur. Kol radio ola checkbox khassha value dyalha.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>&lt;form action method&gt;</b> envoie les champs vers un fichier PHP : <b>get</b> => $_GET (URL partagée), <b>post</b> => $_POST (sensible, fichiers). Chaque champ porte un <b>name</b> (unique pour radio, en <b>[]</b> pour les groupes) et un <b>label for</b> relié à son <b>id</b>. <b>textarea</b>, <b>select/option</b>, <b>fieldset/legend</b> et <b>button submit</b> complètent l\'équipe ; <b>enctype="multipart/form-data"</b> pour les fichiers. Le traitement se fera en PHP (module PHP, ch. 9).',
        'darija' => '<b>form</b> kaysift les champs l PHP : <b>get</b> => $_GET f URL, <b>post</b> => $_POST (data dyal sensitive ola fichiers). Kol champ khassou <b>name</b> (radio b nefs name, checkbox b []), b <b>label</b> mrboT bel <b>for=id</b>. <b>textarea</b> dyal texte twil, <b>select/option</b> dyal liste, <b>fieldset/legend</b> katnormo les groupes, w <b>button submit</b> kaysift. Fichiers : d_<b>enctype</b>. Le traitement : PHP, module PHP ch. 9.',
    ],
];
