<?php
declare(strict_types=1);

return [
    'id' => 'php-ex17',
    'title' => 'Interfaces, contrats et traits',
    'brief' => 'Deux exercices progressifs avec correction.',
    'levels' => [
        [
            'level' => 1,
            'title' => 'Déclarez Affichable, Cours et presenter ; presenter(new Cours()) doit renvoyer PHP.',
            'lang' => 'php',
            'instructions' => '<p>Déclarez Affichable, Cours et presenter ; presenter(new Cours()) doit renvoyer PHP.</p>',
            'instructionsDarija' => '<p>Sawb interface Affichable w classe Cours w presenter li katrje3 PHP.</p>',
            'starter' => '<?php
// Votre solution
',
            'tests' => [
                [
                    'type' => 'output_contains',
                    'value' => 'PHP'
                ]
            ],
            'hints' => [
                'Un paramètre typé Affichable accepte plusieurs classes concrètes qui respectent cette interface. Le code appelant connaît la méthode promise sans dépendre de la construction de l’objet. Cette séparation permet de remplacer une implémentation lors d’un test ou d’une évolution du programme.'
            ],
            'solution' => '<?php
interface Affichable {
    public function libelle(): string;
}
class Cours implements Affichable {
    public function libelle(): string { return "PHP"; }
}
function presenter(Affichable $objet): string { return $objet->libelle(); }
echo presenter(new Cours());',
            'explainFr' => 'Résultat attendu : PHP. Un paramètre typé Affichable accepte plusieurs classes concrètes qui respectent cette interface. Le code appelant connaît la méthode promise sans dépendre de la construction de l’objet. Cette séparation permet de remplacer une implémentation lors d’un test ou d’une évolution du programme.',
            'explainDarija' => 'Sawb interface Affichable w classe Cours w presenter li katrje3 PHP.'
        ],
        [
            'level' => 2,
            'title' => 'Créez NomNormalise et utilisez-le dans Etiquette pour normaliser la chaîne «  PHP  ».',
            'lang' => 'php',
            'instructions' => '<p>Créez NomNormalise et utilisez-le dans Etiquette pour normaliser la chaîne «  PHP  ».</p>',
            'instructionsDarija' => '<p>Sawb trait NomNormalise w sta3mlo f Etiquette bach trje3 php bla espaces.</p>',
            'starter' => '<?php
// Votre solution
',
            'tests' => [
                [
                    'type' => 'output_contains',
                    'value' => 'php'
                ]
            ],
            'hints' => [
                'Un trait fournit du code de méthodes à insérer dans une classe avec use. Ce use situé dans la classe est distinct de l’import d’un namespace. Un trait n’est pas un objet et ne sert pas de type de paramètre. Gardez les traits petits et cohérents ; ici, trim retire les espaces et strtolower traite les lettres ASCII de PHP.'
            ],
            'solution' => '<?php
trait NomNormalise {
    public function normaliser(string $nom): string {
        return strtolower(trim($nom));
    }
}
class Etiquette { use NomNormalise; }
echo (new Etiquette())->normaliser("  PHP  ");',
            'explainFr' => 'Résultat attendu : php. Un trait fournit du code de méthodes à insérer dans une classe avec use. Ce use situé dans la classe est distinct de l’import d’un namespace. Un trait n’est pas un objet et ne sert pas de type de paramètre. Gardez les traits petits et cohérents ; ici, trim retire les espaces et strtolower traite les lettres ASCII de PHP.',
            'explainDarija' => 'Sawb trait NomNormalise w sta3mlo f Etiquette bach trje3 php bla espaces.'
        ]
    ]
];
