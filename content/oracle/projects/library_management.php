<?php
declare(strict_types=1);

/**
 * Module de gestion de bibliothèque pour Oracle Database XE.
 * Permet de gérer le catalogue de livres, les emprunts et les membres.
 */

return [
    'id' => 'oracle-project-library-management',
    'title' => 'Gestion Bibliothèque',
    'brief' => 'Gérez le catalogue de livres, les emprunts et les membres.',
    'descriptionFr' => 'Ce projet utilise Oracle Database XE pour gérer un système de bibliothèque : catalogue de livres, adhésion des membres, suivi des emprunts et retours, et recherches dans le catalogue. Il couvre la création de tables, les fonctions d\'agrégation, les jointures, les vues, les procédures stockées et les triggers de gestion des retards.',
    'descriptionDarija' => 'Hada project kay l9der g9i gestion library f Oracle Database XE : catalogue livres, adhésion membres, suivi emprunts w retours, w recherches catalogue. Kaylik création tables, fonctions agrégation, jointures, vues, procédures stockées w triggers gestion retards.',
    'difficulty' => 'intermediate',
    'estimatedTime' => '3.5 heures',
    'tables' => [
        'members' => [
            'description' => 'Table des membres',
            'columns' => [
                'member_id' => 'NUMBER PRIMARY KEY',
                'first_name' => 'VARCHAR2(50)',
                'last_name' => 'VARCHAR2(50)',
                'email' => 'VARCHAR2(100) UNIQUE',
                'join_date' => 'DATE DEFAULT SYSDATE',
            ],
        ],
        'books' => [
            'description' => 'Table des livres',
            'columns' => [
                'isbn' => 'VARCHAR2(13) PRIMARY KEY',
                'title' => 'VARCHAR2(200)',
                'author' => 'VARCHAR2(100)',
                'genre' => 'VARCHAR2(50)',
                'available' => 'NUMBER DEFAULT 1',  // 1 = disponible, 0 = emprunté
            ],
        ],
        'borrowings' => [
            'description' => 'Table des emprunts',
            'columns' => [
                'borrow_id' => 'NUMBER PRIMARY KEY',
                'member_id' => 'NUMBER',
                'isbn' => 'VARCHAR2(13)',
                'borrow_date' => 'DATE DEFAULT SYSDATE',
                'return_date' => 'DATE',
                'PRIMARY KEY (borrow_id)',
                'FOREIGN KEY (member_id) REFERENCES members(member_id)',
                'FOREIGN KEY (isbn) REFERENCES books(isbn)',
            ],
        ],
    ],
    'procedures' => [
        'sp_add_member' => 'Enregistrer un nouveau membre',
        'sp_borrow_book' => 'Enregistrer un emprunt',
        'sp_return_book' => 'Enregistrer un retour',
        'sp_list_overdue_books' => 'Lister les livres en retard',
    ],
    'triggers' => [
        'trg_check_availability' => 'Vérifier la disponibilité avant emprunt',
        'trg_update_availability' => 'Mettre à jour le statut de disponibilité après retour',
    ],
    'views' => [
        'v_borrowing_status' => 'Vue affichant le statut des emprunts actuels',
    ],
    'objectives' => [
        'Créer et gérer des tables de bibliothèque',
        'Gérer les emprunts et retours de livres',
        'Rechercher dans le catalogue par titre, auteur ou genre',
        'Identifier les livres en retard',
        'Mettre en place des triggers de gestion',
    ],
    'milestones' => [
        'Créer la base de données et les tables',
        'Insérer des données d\'exemple (membres et livres)',
        'Effectuer un emprunt',
        'Effectuer un retour',
        'Lister les livres en retard',
        'Créer une vue de statut d\'emprunt',
    ],
];