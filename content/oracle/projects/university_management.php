<?php
declare(strict_types=1);

/**
 * Système complet de gestion universitaire pour Oracle Database XE.
 * Gère tous les aspects d'une université : étudiants, cours, professeurs, départements, etc.
 */

return [
    'id' => 'oracle-project-university-management',
    'title' => 'Gestion Universitaire Complète',
    'brief' => 'Système complet de gestion universitaire : étudiants, cours, professeurs, départements.',
    'descriptionFr' => 'Ce projet complet utilise Oracle Database XE pour modéliser et gérer un système universitaire complet : départements, cours, professeurs, étudiants, inscriptions, notes, emplois du temps et rapports institutionnels. Il couvre tous les concepts Oracle abordés dans le module : DDL, DML, jointures, sous-requêtes, vues, procédures stockées, fonctions, packages, triggers et gestion d\'erreurs. C\'est le projet d\'intégration final qui synthétise l\'ensemble du module.',
    'descriptionDarija' => 'Hada project kamil kay l9der gérer système universitaire complet f Oracle Database XE : départements, cours, professeurs, étudiants, inscriptions, notes, emplois du temps w rapports institutionnels. Kaylik tous concepts Oracle : DDL, DML, jointures, sous-requêtes, vues, procédures stockées, fonctions, packages, triggers w gestion erreurs. Hada project intégration final synthétise ensemble module.',
    'difficulty' => 'advanced',
    'estimatedTime' => '6 heures',
    'tables' => [
        'departments' => [
            'description' => 'Table des départements',
            'columns' => [
                'department_id' => 'NUMBER PRIMARY KEY',
                'name' => 'VARCHAR2(100)',
                'budget' => 'NUMBER',
            ],
        ],
        'professors' => [
            'description' => 'Table des professeurs',
            'columns' => [
                'professor_id' => 'NUMBER PRIMARY KEY',
                'first_name' => 'VARCHAR2(50)',
                'last_name' => 'VARCHAR2(50)',
                'email' => 'VARCHAR2(100) UNIQUE',
                'department_id' => 'NUMBER',
                'FOREIGN KEY (department_id) REFERENCES departments(department_id)',
            ],
        ],
        'students' => [
            'description' => 'Table des étudiants',
            'columns' => [
                'student_id' => 'NUMBER PRIMARY KEY',
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
                'department_id' => 'NUMBER',
                'professor_id' => 'NUMBER',
                'FOREIGN KEY (department_id) REFERENCES departments(department_id)',
                'FOREIGN KEY (professor_id) REFERENCES professors(professor_id)',
            ],
        ],
        'enrollments' => [
            'description' => 'Table des inscriptions',
            'columns' => [
                'enrollment_id' => 'NUMBER PRIMARY KEY',
                'student_id' => 'NUMBER',
                'course_id' => 'NUMBER',
                'grade' => 'VARCHAR2(2)',
                'semester' => 'VARCHAR2(20)',
                'FOREIGN KEY (student_id) REFERENCES students(student_id)',
                'FOREIGN KEY (course_id) REFERENCES courses(course_id)',
            ],
        ],
        'offices' => [
            'description' => 'Table des bureaux',
            'columns' => [
                'office_id' => 'NUMBER PRIMARY KEY',
                'building' => 'VARCHAR2(50)',
                'room_number' => 'VARCHAR2(10)',
                'professor_id' => 'NUMBER UNIQUE',
                'FOREIGN KEY (professor_id) REFERENCES professors(professor_id)',
            ],
        ],
    ],
    'procedures' => [
        'sp_add_student' => 'Inscrire un nouvel étudiant',
        'sp_add_course' => 'Créer un nouveau cours',
        'sp_enroll_student' => 'Inscrire un étudiant à un cours',
        'sp_calculate_department_budget' => 'Calculer le budget total d\'un département',
        'sp_list_students_by_department' => 'Lister les étudiants d\'un département',
    ],
    'functions' => [
        'fn_calculate_course_credits' => 'Calculer le total de crédits pour un cours',
        'fn_student_average_grade' => 'Calculer la moyenne des notes d\'un étudiant',
    ],
    'triggers' => [
        'trg_prevent_duplicate_enrollment' => 'Empêcher qu\'un étudiant ne s\'inscrive deux fois au même cours',
        'trg_check_grade_range' => 'Valider que les notes sont comprises entre 0 et 20',
    ],
    'views' => [
        'v_student_transcript' => 'Vue transcript partielle d\'un étudiant',
        'v_course_roster' => 'Vue affichant la liste des étudiants par cours',
        'v_department_summary' => 'Vue résumé d\'un département (professeurs, étudiants, budget)',
    ],
    'packages' => [
        'pk_academic_utils' => 'Package regroupant des utilitaires académiques',
    ],
    'objectives' => [
        'Modéliser une base de données universitaire complète',
        'Créer et gérer toutes les tables relationnelles',
        'Utiliser des jointures complexes (INNER, LEFT, RIGHT, FULL)',
        'Écrire des sous-requêtes corrélées et non corrélées',
        'Créer des procédures stockées et des fonctions',
        'Développer et utiliser des packages Oracle',
        'Mettre en place des triggers de intégrité',
        'Créer des vues de reporting institutionnel',
    ],
    'milestones' => [
        'Créer la base de données avec tous les schémas',
        'Insérer des données d\'exemple (départements, professeurs)',
        'Créer des tables d\'étudiants et de cours',
        'Effectuer des inscriptions',
        'Créer et exécuter des procédures stockées',
        'Créer des fonctions utilisateur',
        'Créer un package avec utilitaires',
        'Mettre en place des triggers d\'intégrité',
        'Créer des vues de reporting',
        'Générer des rapports institutionnels complets',
    ],
];