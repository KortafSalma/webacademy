<?php
declare(strict_types=1);

return [
    'title' => 'Quiz — Namespaces et alias de classes',
    'questions' => [
        [
            'type' => 'mcq',
            'question' => 'À quoi sert un namespace ?',
            'options' => [
                'Éviter les collisions de noms',
                'Créer une table SQL',
                'Chiffrer une classe'
            ],
            'answer' => 0,
            'concept' => 'Namespaces et alias de classes',
            'explainFr' => 'Il qualifie les noms des identifiants.',
            'explainDarija' => 'Kayferre9 smiyat dyal classes.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Que fait use DateTimeImmutable as DateCours ?',
            'options' => [
                'Définit un alias local au fichier',
                'Copie la classe',
                'Installe une dépendance'
            ],
            'answer' => 0,
            'concept' => 'Namespaces et alias de classes',
            'explainFr' => 'use résout un nom ; il ne charge pas le code.',
            'explainDarija' => 'use kay3ti alias, ma kaychargech code.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Quel nom part de l’espace global ?',
            'options' => [
                '\\DateTimeImmutable',
                'this.DateTimeImmutable',
                'DateCours seulement'
            ],
            'answer' => 0,
            'concept' => 'Namespaces et alias de classes',
            'explainFr' => 'Le premier antislash indique un nom absolu.',
            'explainDarija' => 'Antislash f lbidaya kay3ni nom absolu.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Où un alias use est-il défini ?',
            'options' => [
                'Dans le fichier courant',
                'Automatiquement dans tout le projet',
                'Dans la base de données'
            ],
            'answer' => 0,
            'concept' => 'Namespaces et alias de classes',
            'explainFr' => 'Les imports sont propres au fichier.',
            'explainDarija' => 'Imports kayb9aw f fichier dyalhom.'
        ],
        [
            'type' => 'mcq',
            'question' => 'Que représente P2D dans DateInterval ?',
            'options' => [
                'Deux jours',
                'Deux mois',
                'Deux heures'
            ],
            'answer' => 0,
            'concept' => 'Namespaces et alias de classes',
            'explainFr' => 'D correspond aux jours dans cette durée.',
            'explainDarija' => 'D kat3ni iyam f had durée.'
        ]
    ]
];
