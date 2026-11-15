<?php
declare(strict_types=1);

return [
    'id' => 'php-ch16',
    'title' => 'Namespaces et alias de classes',
    'subtitle' => 'Comprendre, pratiquer et vérifier ses résultats.',
    'objectives' => [
        'Comprendre : Organiser les identifiants.',
        'Comprendre : Utiliser un nom absolu.',
        'Comprendre : Importer un alias.'
    ],
    'lessons' => [
        [
            'id' => 'notion-1',
            'title' => 'Organiser les identifiants',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Deux bibliothèques peuvent définir une classe Client. Les noms <code>App\\Vente\\Client</code> et <code>App\\Support\\Client</code> les distinguent. La déclaration <code>namespace App\\Vente;</code> se place au début d’un fichier, après un éventuel declare. Un namespace organise les noms : il ne définit pas des permissions. Les exercices utilisent les classes globales pour rester compatibles avec le runner.</p>',
                    'darija' => '<p>Jouj bibliothèques y9dro ykoun 3endhom Client. Namespace kayferre9 bin App\\Vente\\Client w App\\Support\\Client. Déclaration katji f lbidaya. Namespace kayorganisi smiyat, machi permissions. Exercices b classes globales bach ykhdmo f runner.</p>'
                ]
            ]
        ],
        [
            'id' => 'notion-2',
            'title' => 'Utiliser un nom absolu',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Un antislash au début part de l’espace global. <code>new \\DateTimeImmutable(...)</code> vise la classe standard même dans un autre namespace. Une date fixée donne un résultat reproductible. DateTimeImmutable ne modifie pas l’objet d’origine lorsqu’on lui ajoute une durée : elle retourne une nouvelle date.</p>',
                    'darija' => '<p>Antislash f lbidaya kaybda men espace global. \\DateTimeImmutable classe standard même dakhel namespace. Date fixe kat3ti résultat reproducible. Add katrje3 date jdida bla ma tbeddel l9dima.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Utiliser un nom absolu',
                    'lang' => 'php',
                    'code' => '<?php
$date = new \\DateTimeImmutable("2026-01-15");
echo $date->format("Y-m-d");',
                    'output' => '2026-01-15',
                    'explainFr' => 'Un antislash au début part de l’espace global. <code>new \\DateTimeImmutable(...)</code> vise la classe standard même dans un autre namespace. Une date fixée donne un résultat reproductible. DateTimeImmutable ne modifie pas l’objet d’origine lorsqu’on lui ajoute une durée : elle retourne une nouvelle date.',
                    'explainDarija' => 'Antislash f lbidaya kaybda men espace global. \\DateTimeImmutable classe standard même dakhel namespace. Date fixe kat3ti résultat reproducible. Add katrje3 date jdida bla ma tbeddel l9dima.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-3',
            'title' => 'Importer un alias',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p><code>use Nom as Alias;</code> raccourcit le nom dans le fichier courant. Il ne charge aucun fichier et ne remplace pas require ou un autoloader. L’alias n’est pas automatiquement disponible dans les autres fichiers et ne renomme pas la classe originale. Dans cet exemple, P2D représente une durée de deux jours.</p>',
                    'darija' => '<p>use m3a as kay9esser smiya f fichier courant. Ma kaycharge 7ta fichier w ma kay3ewwedch require wla autoloader. Alias ghir f had fichier, ma kaybeddelch smiya originale. P2D jouj iyam.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Importer un alias',
                    'lang' => 'php',
                    'code' => '<?php
use DateTimeImmutable as DateCours;
use DateInterval as Duree;
$date = new DateCours("2026-01-15");
echo $date->add(new Duree("P2D"))->format("Y-m-d");',
                    'output' => '2026-01-17',
                    'explainFr' => '<code>use Nom as Alias;</code> raccourcit le nom dans le fichier courant. Il ne charge aucun fichier et ne remplace pas require ou un autoloader. L’alias n’est pas automatiquement disponible dans les autres fichiers et ne renomme pas la classe originale. Dans cet exemple, P2D représente une durée de deux jours.',
                    'explainDarija' => 'use m3a as kay9esser smiya f fichier courant. Ma kaycharge 7ta fichier w ma kay3ewwedch require wla autoloader. Alias ghir f had fichier, ma kaybeddelch smiya originale. P2D jouj iyam.',
                    'preview' => false
                ]
            ]
        ]
    ],
    'mistakes' => [
        [
            'wrong' => 'Croire que use charge une classe depuis le disque',
            'fix' => 'Prévoir require ou un autoloader pour charger une classe externe.',
            'fr' => 'Prévoir require ou un autoloader pour charger une classe externe.',
            'darija' => 'use ghir alias; chargement kay7taj require wla autoloader.'
        ]
    ],
    'summary' => [
        'fr' => 'Deux bibliothèques peuvent définir une classe Client. Les noms <code>App\\Vente\\Client</code> et <code>App\\Support\\Client</code> les distinguent. La déclaration <code>namespace App\\Vente;</code> se place au début d’un fichier, après un éventuel declare. Un namespace organise les noms : il ne définit pas des permissions. Les exercices utilisent les classes globales pour rester compatibles avec le runner. Un antislash au début part de l’espace global. <code>new \\DateTimeImmutable(...)</code> vise la classe standard même dans un autre namespace. Une date fixée donne un résultat reproductible. DateTimeImmutable ne modifie pas l’objet d’origine lorsqu’on lui ajoute une durée : elle retourne une nouvelle date. <code>use Nom as Alias;</code> raccourcit le nom dans le fichier courant. Il ne charge aucun fichier et ne remplace pas require ou un autoloader. L’alias n’est pas automatiquement disponible dans les autres fichiers et ne renomme pas la classe originale. Dans cet exemple, P2D représente une durée de deux jours.',
        'darija' => 'Jouj bibliothèques y9dro ykoun 3endhom Client. Namespace kayferre9 bin App\\Vente\\Client w App\\Support\\Client. Déclaration katji f lbidaya. Namespace kayorganisi smiyat, machi permissions. Exercices b classes globales bach ykhdmo f runner. Antislash f lbidaya kaybda men espace global. \\DateTimeImmutable classe standard même dakhel namespace. Date fixe kat3ti résultat reproducible. Add katrje3 date jdida bla ma tbeddel l9dima. use m3a as kay9esser smiya f fichier courant. Ma kaycharge 7ta fichier w ma kay3ewwedch require wla autoloader. Alias ghir f had fichier, ma kaybeddelch smiya originale. P2D jouj iyam.'
    ]
];
