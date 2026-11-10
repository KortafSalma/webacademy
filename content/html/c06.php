<?php

declare(strict_types=1);

/**
 * MODULE HTML — Chapitre 6 : Tableaux
 * Format identique à content/html/c01.php.
 */

return [
    'id'       => 'html-ch6',
    'title'    => 'Tableaux',
    'subtitle' => 'Présenter des données en lignes et colonnes : <table>, cellules, fusion et accessibilité.',

    'objectives' => [
        'Construire un tableau avec <code>table</code>, <code>tr</code>, <code>td</code> et <code>th</code>.',
        'Titre un tableau avec <code>caption</code>.',
        'Organiser l\'en-tête, le corps et le pied avec <code>thead</code>, <code>tbody</code>, <code>tfoot</code>.',
        'Fusionner des cellules horizontalement et verticalement avec <code>colspan</code> et <code>rowspan</code>.',
        'Rendre le tableau accessible avec l\'attribut <code>scope</code>.',
    ],

    'lessons' => [

        // ------------------------------------------------ Section 1
        [
            'id'    => 'structure-base',
            'title' => 'La structure d\'un tableau',
            'icon'  => '🗂️',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Un <strong>tableau</strong> présente des données en <strong>lignes</strong> et <strong>colonnes</strong> : notes, horaires, tarifs, résultats de recherche… En HTML, un tableau se construit avec trois balises de base :</p><ul><li><code>&lt;table&gt;</code> : le tableau entier ;</li><li><code>&lt;tr&gt;</code> (table row) : une ligne ;</li><li><code>&lt;td&gt;</code> (table data) : une cellule de données, à l\'intérieur d\'une ligne.</li></ul><p>On écrit donc toujours <em>de l\'extérieur vers l\'intérieur</em> : le tableau contient des lignes, la ligne contient des cellules.</p>',
                 'darija' => '<p>Tableau kat9sm data l des lignes w colonnes : notes, horaires, prix… 3 balises l\'essentiel : <code>&lt;table&gt;</code> hiya le tableau kamel, <code>&lt;tr&gt;</code> hiya ligne wahida, w <code>&lt;td&gt;</code> hiya cellule f dak la ligne. Diman kteb mn les briya : table fih tr, w tr fih td.</p>'],

                ['type' => 'definition', 'title' => 'td vs th',
                 'fr'   => '<p><strong>&lt;td&gt;</strong> : cellule de <em>données</em> ordinaire.<br><strong>&lt;th&gt;</strong> (table header) : cellule d\'<em>en-tête</em> — titre de colonne ou de ligne. Le navigateur la met en gras et centré, et les lecteurs d\'écran la lisent comme en-tête.</p>',
                 'darija' => '<p><code>&lt;td&gt;</code> hiya cellule 3adiya fin kayn data. <code>&lt;th&gt;</code> hiya cellule dyal titre (cole dyal colonne ola dyal ligne), le navigateur kaykhalliha gras w centre, w lecteurs d\'écran kayfhemou belli hadi titre.</p>'],

                ['type' => 'example',
                 'title' => 'Tableau de notes minimal',
                 'lang'  => 'html',
                 'code'  => '<table>
  <tr>
    <th>Module</th>
    <th>Note</th>
  </tr>
  <tr>
    <td>HTML</td>
    <td>16</td>
  </tr>
  <tr>
    <td>PHP</td>
    <td>13</td>
  </tr>
</table>',
                 'preview' => true,
                 'explainFr' => 'La première <em>ligne</em> utilise <code>&lt;th&gt;</code> : ce sont les titres de colonnes. Les deux lignes suivantes contiennent les données dans des <code>&lt;td&gt;</code>. Sans CSS, le navigateur n\'affiche pas de bordures — mais la structure est correcte.',
                 'explainDarija' => 'Awal la ligne (<code>&lt;tr&gt;</code>) fiha <code>&lt;th&gt;</code> : titres dyal colonnes (Module, Note). Men ba3d kol ligne fiha td dyal data. Ila ma 3andekch CSS, mahadich ybayen les bordures, walakin structure s7i7a.'],

                ['type' => 'tip',
                 'title' => 'Caption : donnez toujours un titre à votre tableau',
                 'fr'   => 'La balise <code>&lt;caption&gt;</code> se place juste après <code>&lt;table&gt;</code> et affiche un titre au-dessus du tableau. Elle est lue en premier par les lecteurs d\'écran : indispensable pour comprendre le tableau sans le voir.',
                 'darija' => '<code>&lt;caption&gt;</code> katzid titre fo9 le tableau. Katktb dima juste ba3d <code>&lt;table&gt;</code>. Les lecteurs d\'écran kayqrawha bel lewel, donc l\'utilisateur tifh wach kayn f tableau bla ma ychofo.'],
            ],
        ],

        // ------------------------------------------------ Section 2
        [
            'id'    => 'thead-tbody-tfoot',
            'title' => 'thead, tbody, tfoot et l\'attribut scope',
            'icon'  => '🧱',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Un tableau professionnel se découpe en <strong>trois zones</strong> :</p><ul><li><code>&lt;thead&gt;</code> : la (ou les) ligne(s) d\'en-tête ;</li><li><code>&lt;tbody&gt;</code> : le corps, toutes les lignes de données ;</li><li><code>&lt;tfoot&gt;</code> : le pied — total, synthèse, note de bas de tableau.</li></ul><p>Ces trois balises <em>ne créent aucune ligne</em> : elles regroupent les <code>&lt;tr&gt;</code> déjà existants. Elles permettent au navigateur de garder l\'en-tête visible lors d\'un défilement, et aux outils d\'accessibilité de s\'y repérer.</p>',
                 'darija' => '<p>Tableau professionnel kat9ssmhou 3 zones : <code>&lt;thead&gt;</code> fin kayn titres, <code>&lt;tbody&gt;</code> fin kayn data, w <code>&lt;tfoot&gt;</code> fin kayn total ola remarque. Had 3 balises machi kaykhdmo ligne — ghir kayjm3ou les lignes li fihom. Mfida dyal scroll : thead tbqa fo9.</p>'],

                ['type' => 'definition', 'title' => 'scope : relier cellules et en-têtes',
                 'fr'   => '<p>L\'attribut <code>scope</code> se met sur chaque <code>&lt;th&gt;</code> : <code>scope="col"</code> (« cette cellule est le titre de la colonne ») ou <code>scope="row"</code> (« titre de la ligne »). Les lecteurs d\'écran annoncent alors : « Ligne Heure, colonne Lundi… » — l\'utilisateur aveugle comprend de quelle cellule il s\'agit.</p>',
                 'darija' => '<code>scope</code> attribut katzidou f <code>&lt;th&gt;</code> : <code>scope="col"</code> kaygol belli had la cellule hiya titre dyal colonne, w <code>scope="row"</code> titre dyal ligne. Hekka lecteur d\'écran kayqra « Lundi, 8h30… » w l\'utilisateur y3ref fin rah.'],

                ['type' => 'example',
                 'title' => 'Tableau structuré avec thead / tbody / tfoot',
                 'lang'  => 'html',
                 'code'  => '<table>
  <caption>Notes du module HTML — 2ème semestre</caption>
  <thead>
    <tr>
      <th scope="col">Étudiant</th>
      <th scope="col">Devoir</th>
      <th scope="col">Examen</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Amine</th>
      <td>12</td>
      <td>15</td>
    </tr>
    <tr>
      <th scope="row">Nada</th>
      <td>14</td>
      <td>17</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="3">Moyenne de classe : 14,5 / 20</td>
    </tr>
  </tfoot>
</table>',
                 'preview' => true,
                 'explainFr' => 'Chaque <code>&lt;th&gt;</code> porte son <code>scope</code> : "col" pour les 3 titres de colonnes, "row" pour les noms d\'étudiants (titres de lignes). Le pied de tableau utilise déjà <code>colspan="3"</code> : une cellule « Moyenne » qui s\'étend sur les 3 colonnes — nous le détaillons juste après.',
                 'explainDarija' => 'Kol <code>&lt;th&gt;</code> 3andou <code>scope</code> : "col" dyal titres dyal colonnes, "row" dyal smiya dyal étudiant (titre dyal ligne). F tfoot khedemna <code>colspan="3"</code> : cellule wa7da 3abra 3 colonnes — ghadi nchrfouha mn ba3d.'],
            ],
        ],

        // ------------------------------------------------ Section 3
        [
            'id'    => 'colspan-rowspan',
            'title' => 'Fusionner des cellules : colspan et rowspan',
            'icon'  => '🔗',
            'blocks' => [

                ['type' => 'text',
                 'fr'   => '<p>Parfois une cellule doit occuper <strong>plusieurs colonnes</strong> ou <strong>plusieurs lignes</strong> : un titre qui couvre le tableau entier, une pause déjeuner commune à tous les jours, une séance de cours de 2 heures… Deux attributs le permettent, <em>uniquement sur des cellules</em> (<code>td</code> ou <code>th</code>) :</p><ul><li><code>colspan="n"</code> : la cellule s\'étend sur <strong>n colonnes</strong> (horizontalement) ;</li><li><code>rowspan="n"</code> : la cellule s\'étend sur <strong>n lignes</strong> (verticalement).</li></ul><p>Règle d\'or : après une fusion, il faut <strong>écrire moins de cellules</strong> dans les lignes suivantes. Une cellule qui fusionne <em>remplace</em> celles qu\'elle recouvre — ne les écrivez jamais en double.</p>',
                 'darija' => '<p>Marrtin kankono bghina cellule wa7da tdkhol f bzzaf dyal colonnes ola lignes : titre 3al tableau kamel, pause déjeuner dyal les jours kamlin, cours dyal sa3tin… 3andek jouj attributs 3la <code>td</code> ola <code>th</code> : <code>colspan="n"</code> kayweddi horizontally f n colonnes, w <code>rowspan="n"</code> kayweddi verticalement f n lignes. Règle mohimma : mn ba3d fusion, ktseb tkteb cellules qlal f les lignes li f9 — la cellule li drmou fiha fusion katbdel blast les cellules lokhrin, machi khass tktebhom zid.</p>'],

                ['type' => 'warning',
                 'title' => 'Le piège classique',
                 'fr'   => 'Erreur n°1 de l\'étudiant : mettre <code>colspan="3"</code> tout en gardant 3 cellules dans la même ligne (total de 4 colonnes affichées), ou écrire la cellule fusionnée par <code>rowspan</code> dans les lignes du dessous. Le tableau devient tordu. Comptez toujours : chaque ligne doit « coûter » exactement le nombre de colonnes du tableau.',
                 'darija' => 'L\'erreur li kaydir kol etudiant : kaykteb <code>colspan="3"</code> w ytabqa kateb 3 cellules f nefs la ligne, wola kay3awed cellule li fusionnat b rowspan f kol ligne. Tableau kaytchouh mkherbeq. 7seb dima : kol la ligne khass t3mmer exactement colonnes li kaynyn f tableau.'],

                ['type' => 'example',
                 'title' => 'Emploi du temps réel : colspan + rowspan',
                 'lang'  => 'html',
                 'code'  => '<table>
  <caption>Emploi du temps — Semaine du 12 octobre</caption>
  <thead>
    <tr>
      <th scope="col">Horaire</th>
      <th scope="col">Lundi</th>
      <th scope="col">Mardi</th>
      <th scope="col">Mercredi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">08:30 – 10:30</th>
      <td rowspan="2" colspan="1">Développement Web (séance double)</td>
      <td>Algorithmique</td>
      <td>PHP</td>
    </tr>
    <tr>
      <th scope="row">10:45 – 12:45</th>
      <!-- La cellule "Développement Web" continue tout seule grâce au rowspan -->
      <td>Algorithmique (TP)</td>
      <td>Base de données</td>
    </tr>
    <tr>
      <th scope="row">12:45 – 14:00</th>
      <td colspan="3">Pause déjeuner</td>
    </tr>
    <tr>
      <th scope="row">14:00 – 16:00</th>
      <td>Anglais</td>
      <td>Projet tutoré</td>
      <td>HTML / CSS</td>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4">Total : 4 blocs de cours — du lundi au mercredi</td>
    </tr>
  </tfoot>
</table>',
                 'preview' => true,
                 'explainFr' => 'Lecture ligne par ligne : la séance « Développement Web » utilise <code>rowspan="2"</code> — elle occupe la colonne Lundi sur les deux créneaux du matin ; la ligne de 10:45 ne contient donc que 3 cellules (horaire + 2 matières + le rowspan déjà compté). La pause déjeuner prend <code>colspan="3"</code> sur toute la largeur, et le pied du tableau <code>colspan="4"</code> avec le th de « Horaire ». Tout cela est exactement le genre de grille qu\'un vrai emploi du temps universitaire utilise.',
                 'explainDarija' => 'Chof la ligne b la ligne : « Développement Web » 3andha <code>rowspan="2"</code> — tdkhol la colonne Lundi f jouj créneaux dyal sba7, donc la ligne dyal 10:45 fiha ghir 3 cellules. « Pause déjeuner » 3andha <code>colspan="3"</code> 3la 3 days, w tfoot <code>colspan="4"</code>. Hadi hiya nefs l\'idée li kaydirou f les grilles dyal les universités w les écoles 7aqiqiyan.'],

                ['type' => 'keywords', 'items' => [
                    ['kw' => '&lt;table&gt;', 'fr' => 'Conteneur du tableau', 'darija' => 'Le tableau kamel'],
                    ['kw' => '&lt;caption&gt;', 'fr' => 'Titre du tableau, lu en premier', 'darija' => 'Titre dyal le tableau'],
                    ['kw' => '&lt;tr&gt;', 'fr' => 'Une ligne', 'darija' => 'Ligne wahida'],
                    ['kw' => '&lt;th&gt;', 'fr' => 'Cellule d\'en-tête (titre)', 'darija' => 'Cellule dyal titre'],
                    ['kw' => '&lt;td&gt;', 'fr' => 'Cellule de données', 'darija' => 'Cellule dyal data'],
                    ['kw' => 'colspan', 'fr' => 'Fusion horizontale (n colonnes)', 'darija' => 'Dmej horizontalement'],
                    ['kw' => 'rowspan', 'fr' => 'Fusion verticale (n lignes)', 'darija' => 'Dmej verticalement'],
                    ['kw' => 'thead / tbody / tfoot', 'fr' => 'Zones en-tête / corps / pied', 'darija' => 'Zones dyal titre / data / fin dyal tableau'],
                    ['kw' => 'scope', 'fr' => 'Accessibilité : rôle du th (col ou row)', 'darija' => 'Katesref lecteur d\'écran chno hiya dak th'],
                ]],
            ],
        ],
    ],

    'mistakes' => [
        [
            'wrong'  => 'Utiliser des div ou du CSS à la place d\'un vrai tableau',
            'fix'    => 'table > tr > td/th',
            'fr'     => 'Un tableau de données se construit toujours avec <code>&lt;table&gt;</code>. Une grille faite en <code>div</code>+CSS empile des boîtes : un lecteur d\'écran ne comprend plus les relations ligne/colonne, et les données deviennent inutilisables hors de la page.',
            'darija' => 'Data fin kayn lignes w colonnes khassha dima <code>&lt;table&gt;</code> ghir. Ila dirhom b div w CSS, lecteur d\'écran maghadich yfhem chkoun m3a chkoun marbout, w data yqel qosoul mn la page.',
        ],
        [
            'wrong'  => '<td colspan="3"> alors que la ligne contient encore 3 cellules',
            'fix'    => 'Retirer les cellules recouvertes par la fusion',
            'fr'     => 'Une fusion <em>remplace</em> les cellules qu\'elle recouvre. Avec colspan="3" dans un tableau à 3 colonnes, la ligne ne contient plus que cette cellule unique.',
            'darija' => 'Mnin dir <code>colspan</code> ola <code>rowspan</code>, la cellule li fusionnat katghatti blast dak les cellules lokhrin — mahouch 7al tkteb nefs la cellule marra 7ra. Kol la ligne khass tkoun fiha ghir les cellules li ba9in mn ba3d la fusion.',
        ],
        [
            'wrong'  => 'td à la place de th pour les en-têtes',
            'fix'    => 'th + scope',
            'fr'     => 'Les titres de ligne/colonne doivent être des <code>&lt;th&gt;</code> avec <code>scope</code>. Un <code>td</code> dédié ne dit pas au lecteur d\'écran « ceci est un en-tête ».',
            'darija' => 'Titres dyal colonnes ola dyal lignes dima <code>&lt;th&gt;</code> m3a <code>scope</code>. td magadich y3awen l\'utilisateur dyal lecteur d\'écran yfhem belli hadi titre.',
        ],
    ],

    'summary' => [
        'fr'     => '<b>&lt;table&gt;</b> contient des <b>&lt;tr&gt;</b> (lignes) qui contiennent des <b>&lt;td&gt;</b> (données) ou <b>&lt;th&gt;</b> (en-têtes, avec <b>scope</b>). <b>&lt;caption&gt;</b> titre le tableau, <b>thead / tbody / tfoot</b> découpent les zones. <b>colspan</b> fusionne horizontalement, <b>rowspan</b> verticalement — toujours en retirant les cellules recouvertes.',
        'darija' => '<b>table</b> fih <b>tr</b> (lignes), kol tr fiha <b>td</b> (data) ola <b>th</b> (titre + scope). <b>caption</b> katzid titre, w <b>thead/tbody/tfoot</b> kati9smo le tableau zones (titre / data / total). <b>colspan</b> kaydmej horizontally, <b>rowspan</b> vertically — w matensach tna9i les cellules li ghatthom la fusion.',
    ],
];
