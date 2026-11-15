<?php
declare(strict_types=1);

return [
    'id' => 'php-ex16',
    'title' => 'Namespaces et alias de classes',
    'brief' => 'Deux exercices progressifs avec correction.',
    'levels' => [
        [
            'level' => 1,
            'title' => 'Instanciez \\DateTimeImmutable avec 2026-01-15 et affichez la date au format Y-m-d.',
            'lang' => 'php',
            'instructions' => '<p>Instanciez \\DateTimeImmutable avec 2026-01-15 et affichez la date au format Y-m-d.</p>',
            'instructionsDarija' => '<p>Sta3mel nom global DateTimeImmutable w 3red date 2026-01-15.</p>',
            'starter' => '<?php
// Votre solution
',
            'tests' => [
                [
                    'type' => 'output_contains',
                    'value' => '2026-01-15'
                ]
            ],
            'hints' => [
                'Un antislash au début part de l’espace global. <code>new \\DateTimeImmutable(...)</code> vise la classe standard même dans un autre namespace. Une date fixée donne un résultat reproductible. DateTimeImmutable ne modifie pas l’objet d’origine lorsqu’on lui ajoute une durée : elle retourne une nouvelle date.'
            ],
            'solution' => '<?php
$date = new \\DateTimeImmutable("2026-01-15");
echo $date->format("Y-m-d");',
            'explainFr' => 'Résultat attendu : 2026-01-15. Un antislash au début part de l’espace global. <code>new \\DateTimeImmutable(...)</code> vise la classe standard même dans un autre namespace. Une date fixée donne un résultat reproductible. DateTimeImmutable ne modifie pas l’objet d’origine lorsqu’on lui ajoute une durée : elle retourne une nouvelle date.',
            'explainDarija' => 'Sta3mel nom global DateTimeImmutable w 3red date 2026-01-15.'
        ],
        [
            'level' => 2,
            'title' => 'Importez DateTimeImmutable comme DateCours et DateInterval comme Duree ; ajoutez deux jours à 2026-01-15.',
            'lang' => 'php',
            'instructions' => '<p>Importez DateTimeImmutable comme DateCours et DateInterval comme Duree ; ajoutez deux jours à 2026-01-15.</p>',
            'instructionsDarija' => '<p>Dir jouj alias w zid jouj iyam l date 2026-01-15.</p>',
            'starter' => '<?php
// Votre solution
',
            'tests' => [
                [
                    'type' => 'output_contains',
                    'value' => '2026-01-17'
                ]
            ],
            'hints' => [
                '<code>use Nom as Alias;</code> raccourcit le nom dans le fichier courant. Il ne charge aucun fichier et ne remplace pas require ou un autoloader. L’alias n’est pas automatiquement disponible dans les autres fichiers et ne renomme pas la classe originale. Dans cet exemple, P2D représente une durée de deux jours.'
            ],
            'solution' => '<?php
use DateTimeImmutable as DateCours;
use DateInterval as Duree;
$date = new DateCours("2026-01-15");
echo $date->add(new Duree("P2D"))->format("Y-m-d");',
            'explainFr' => 'Résultat attendu : 2026-01-17. <code>use Nom as Alias;</code> raccourcit le nom dans le fichier courant. Il ne charge aucun fichier et ne remplace pas require ou un autoloader. L’alias n’est pas automatiquement disponible dans les autres fichiers et ne renomme pas la classe originale. Dans cet exemple, P2D représente une durée de deux jours.',
            'explainDarija' => 'Dir jouj alias w zid jouj iyam l date 2026-01-15.'
        ]
    ]
];
