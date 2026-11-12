<?php
declare(strict_types=1);

/**
 * Module de gestion étudiante pour Oracle Database XE.
 * Permet de gérer les informations des étudiants (inscription, notes, suivi).
 */

return [
    'id' => 'oracle-project-student-management',
    'title' => 'Gestion Étudiante',
    'brief' => 'Gérez les informations des étudiants : inscription, notes, suivi académique.',
    'descriptionFr' => 'Ce projet utilise Oracle Database XE pour gérer le cycle de vie des étudiants : inscription aux cours, enregistrement des notes, suivi académique et génération de rapports. Il couvre la création de tables, l\'insertion de données, les requêtes de sélection, les jointures, les vues, les procédures stockées et les triggers de validation.',
    'descriptionDarija' => 'Hada project kay l9der gérer cycle vie students f Oracle Database XE : inscription cours, enregistrement notes, suivi académique w génération rapports. Kaylik création tables, insertion données, requêtes sélection, jointures, vues, procédures stockées w triggers validation.',
    'difficulty' => 'intermediate',
    'estimatedTime' => '4 heures',
    'tables' => [
        'students' => [
            'description' => 'Table des étudiants',
            'columns' => [
                'id' => 'NUMBER PRIMARY KEY',
                'first_name' => 'VARCHAR2(50)',
                'last_name' => 'VARCHAR2(50)',
                'email' => 'VARCHAR2(100) UNIQUE',
                'enrollment_date' => 'DATE DEFAULT SYSDATE',
            ],
        ],
        'courses' => [
            'description' => 'Table des cours',
            'columns' => [
                'course_id' => 'NUMBER PRIMARY KEY',
                'title' => 'VARCHAR2(100)',
                'credits' => 'NUMBER',
            ],
        ],
        'enrollments' => [
            'description' => 'Table d\'inscription (relation many-to-many)',
            'columns' => [
                'student_id' => 'NUMBER',
                'course_id' => 'NUMBER',
                'grade' => 'VARCHAR2(2)',
                'PRIMARY KEY (student_id, course_id)',
                'FOREIGN KEY (student_id) REFERENCES students(id)',
                'FOREIGN KEY (course_id) REFERENCES courses(course_id)',
            ],
        ],
    ],
    'procedures' => [
        'sp_add_student' => 'Ajouter un nouvel étudiant',
        'sp_update_grade' => 'Mettre à jour la note d\'un étudiant',
        'sp_list_students_by_course' => 'Lister les étudiants inscrits à un cours',
    ],
    'triggers' => [
        'trg_check_grade' => 'Valider que la note est comprise entre 0 et 20',
    ],
    'views' => [
        'v_student_courses' => 'Vue affichant les étudiants et leurs cours avec notes',
    ],
    'objectives' => [
        'Créer et gérer des tables d\'étudiants et de cours',
        'Utiliser des jointures pour récupérer des informations complètes',
        'Créer et utiliser des procédures stockées',
        'Mettre en place des triggers de validation',
        'Générer des rapports académiques',
    ],
    'milestones' => [
        'Créer la base de données et les tables',
        'Insérer des données d\'exemple',
        'Réaliser des requêtes SELECT avec filtres et tris',
        'Créer une procédure stockée',
        'Créer un trigger de validation',
        'Créer une vue de reporting',
    ],
];