<?php
declare(strict_types=1);

return [
    'title' => 'Quiz — Interfaces, contrats et traits',
    'questions' => [
        [
            'type' => 'mcq',
            'question' => 'Quel mot-clé relie une classe à une interface ?',
            'options' => [
                'implements',
                'namespace',
                'require'
            ],
            'answer' => 0,
            'concept' => 'Interfaces, contrats et traits',
            'explainFr' => 'implements indique le contrat respecté.',
            'explainDarija' => 'implements kay3ni classe kat7tarem contrat.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quel élément fournit des corps de méthodes réutilisables ?',
            'options' => [
                'Un trait',
                'Un namespace',
                'Un alias'
            ],
            'answer' => 0,
            'concept' => 'Interfaces, contrats et traits',
            'explainFr' => 'Un trait insère ses méthodes dans une classe.',
            'explainDarija' => 'Trait kay3ti code méthodes l classe.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Pourquoi typer presenter avec Affichable ?',
            'options' => [
                'Accepter plusieurs classes respectant le contrat',
                'Imposer une seule instance',
                'Supprimer les méthodes'
            ],
            'answer' => 0,
            'concept' => 'Interfaces, contrats et traits',
            'explainFr' => 'Le contrat suffit au code appelant.',
            'explainDarija' => 'Contrat kafi l code li kay3ayet.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Peut-on instancier une interface avec new ?',
            'options' => [
                'Non',
                'Oui, toujours',
                'Uniquement avec une propriété'
            ],
            'answer' => 0,
            'concept' => 'Interfaces, contrats et traits',
            'explainFr' => 'Il faut une classe concrète.',
            'explainDarija' => 'Khass classe concrète bach tdir objet.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Que fait use NomNormalise dans une classe ?',
            'options' => [
                'Insère les méthodes du trait',
                'Charge un fichier',
                'Crée un namespace'
            ],
            'answer' => 0,
            'concept' => 'Interfaces, contrats et traits',
            'explainFr' => 'Dans une classe, ce use applique le trait.',
            'explainDarija' => 'Use dakhel classe kaysta3mel trait.'
        ]
    ]
];
