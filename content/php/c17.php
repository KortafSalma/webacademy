<?php
declare(strict_types=1);

return [
    'id' => 'php-ch17',
    'title' => 'Interfaces, contrats et traits',
    'subtitle' => 'Comprendre, pratiquer et vérifier ses résultats.',
    'objectives' => [
        'Comprendre : Définir un contrat public.',
        'Comprendre : Dépendre du contrat.',
        'Comprendre : Réutiliser une méthode avec un trait.'
    ],
    'lessons' => [
        [
            'id' => 'notion-1',
            'title' => 'Définir un contrat public',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Une interface déclare les méthodes publiques attendues. Une classe utilisant implements doit fournir une implémentation compatible avec leurs signatures. Une interface ne s’instancie pas. Elle sert à exprimer une capacité attendue, pas à partager le corps d’une méthode.</p>',
                    'darija' => '<p>Interface kat3len méthodes publiques li khas classe t3ti. Classe b implements khas t7tarem signature. Ma n9droch ndiro new l interface. Hiya contrat machi code partagé.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Définir un contrat public',
                    'lang' => 'php',
                    'code' => '<?php
interface Affichable {
    public function libelle(): string;
}
class Cours implements Affichable {
    public function libelle(): string { return "PHP"; }
}
function presenter(Affichable $objet): string { return $objet->libelle(); }
echo presenter(new Cours());',
                    'output' => 'PHP',
                    'explainFr' => 'Une interface déclare les méthodes publiques attendues. Une classe utilisant implements doit fournir une implémentation compatible avec leurs signatures. Une interface ne s’instancie pas. Elle sert à exprimer une capacité attendue, pas à partager le corps d’une méthode.',
                    'explainDarija' => 'Interface kat3len méthodes publiques li khas classe t3ti. Classe b implements khas t7tarem signature. Ma n9droch ndiro new l interface. Hiya contrat machi code partagé.',
                    'preview' => false
                ]
            ]
        ],
        [
            'id' => 'notion-2',
            'title' => 'Dépendre du contrat',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Un paramètre typé Affichable accepte plusieurs classes concrètes qui respectent cette interface. Le code appelant connaît la méthode promise sans dépendre de la construction de l’objet. Cette séparation permet de remplacer une implémentation lors d’un test ou d’une évolution du programme.</p>',
                    'darija' => '<p>Paramètre Affichable kay9bel classes mokhtalfin li kay7ترmo contrat. Code kay3ref méthode bla ma ya3ref construction. Hada kaysهل remplacement w tests.</p>'
                ]
            ]
        ],
        [
            'id' => 'notion-3',
            'title' => 'Réutiliser une méthode avec un trait',
            'blocks' => [
                [
                    'type' => 'text',
                    'fr' => '<p>Un trait fournit du code de méthodes à insérer dans une classe avec use. Ce use situé dans la classe est distinct de l’import d’un namespace. Un trait n’est pas un objet et ne sert pas de type de paramètre. Gardez les traits petits et cohérents ; ici, trim retire les espaces et strtolower traite les lettres ASCII de PHP.</p>',
                    'darija' => '<p>Trait kay3ti code méthodes l classe b use dakhel classe, machi use dyal namespace. Trait ma howach objet wla type paramètre. Khllih sghir w wad7. Trim kay7yed espaces, strtolower kayrje3 PHP sghira.</p>'
                ],
                [
                    'type' => 'example',
                    'title' => 'Réutiliser une méthode avec un trait',
                    'lang' => 'php',
                    'code' => '<?php
trait NomNormalise {
    public function normaliser(string $nom): string {
        return strtolower(trim($nom));
    }
}
class Etiquette { use NomNormalise; }
echo (new Etiquette())->normaliser("  PHP  ");',
                    'output' => 'php',
                    'explainFr' => 'Un trait fournit du code de méthodes à insérer dans une classe avec use. Ce use situé dans la classe est distinct de l’import d’un namespace. Un trait n’est pas un objet et ne sert pas de type de paramètre. Gardez les traits petits et cohérents ; ici, trim retire les espaces et strtolower traite les lettres ASCII de PHP.',
                    'explainDarija' => 'Trait kay3ti code méthodes l classe b use dakhel classe, machi use dyal namespace. Trait ma howach objet wla type paramètre. Khllih sghir w wad7. Trim kay7yed espaces, strtolower kayrje3 PHP sghira.',
                    'preview' => false
                ]
            ]
        ]
    ],
    'mistakes' => [
        [
            'wrong' => 'Confondre contrat et réutilisation de code',
            'fix' => 'Utiliser une interface pour le contrat et un trait pour partager des méthodes.',
            'fr' => 'Utiliser une interface pour le contrat et un trait pour partager des méthodes.',
            'darija' => 'Interface contrat, trait code partagé.'
        ]
    ],
    'summary' => [
        'fr' => 'Une interface déclare les méthodes publiques attendues. Une classe utilisant implements doit fournir une implémentation compatible avec leurs signatures. Une interface ne s’instancie pas. Elle sert à exprimer une capacité attendue, pas à partager le corps d’une méthode. Un paramètre typé Affichable accepte plusieurs classes concrètes qui respectent cette interface. Le code appelant connaît la méthode promise sans dépendre de la construction de l’objet. Cette séparation permet de remplacer une implémentation lors d’un test ou d’une évolution du programme. Un trait fournit du code de méthodes à insérer dans une classe avec use. Ce use situé dans la classe est distinct de l’import d’un namespace. Un trait n’est pas un objet et ne sert pas de type de paramètre. Gardez les traits petits et cohérents ; ici, trim retire les espaces et strtolower traite les lettres ASCII de PHP.',
        'darija' => 'Interface kat3len méthodes publiques li khas classe t3ti. Classe b implements khas t7tarem signature. Ma n9droch ndiro new l interface. Hiya contrat machi code partagé. Paramètre Affichable kay9bel classes mokhtalfin li kay7ترmo contrat. Code kay3ref méthode bla ma ya3ref construction. Hada kaysهل remplacement w tests. Trait kay3ti code méthodes l classe b use dakhel classe, machi use dyal namespace. Trait ma howach objet wla type paramètre. Khllih sghir w wad7. Trim kay7yed espaces, strtolower kayrje3 PHP sghira.'
    ]
];
