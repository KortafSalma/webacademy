BEGIN TRANSACTION;
CREATE TABLE etudiant (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            prenom TEXT NOT NULL,
            filiere TEXT NOT NULL DEFAULT 'GI',
            email TEXT UNIQUE
        );
INSERT INTO "etudiant" VALUES(1,'Kortaf','Salma','GI','salma@example.ma');
INSERT INTO "etudiant" VALUES(2,'Marzak','Hiba','GI','hiba@example.ma');
INSERT INTO "etudiant" VALUES(3,'Boukhriss','Omar','GC','omar@example.ma');
INSERT INTO "etudiant" VALUES(4,'Sekkat','Leila','GI','leila@example.ma');
INSERT INTO "etudiant" VALUES(5,'Tazi','Anas','3IA','anas@example.ma');
CREATE TABLE matiere (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT UNIQUE,
            coefficient REAL CHECK (coefficient BETWEEN 1 AND 6)
        );
INSERT INTO "matiere" VALUES(1,'Math',4.0);
INSERT INTO "matiere" VALUES(2,'PHP',3.0);
INSERT INTO "matiere" VALUES(3,'Base de donnees',3.0);
INSERT INTO "matiere" VALUES(4,'Anglais',2.0);
CREATE TABLE note (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            etudiant_id INTEGER NOT NULL,
            matiere_id INTEGER NOT NULL,
            professeur_id INTEGER,
            valeur REAL NOT NULL CHECK (valeur >= 0 AND valeur <= 20),
            date_note TEXT,
            FOREIGN KEY (etudiant_id) REFERENCES etudiant(id),
            FOREIGN KEY (matiere_id) REFERENCES matiere(id)
        );
INSERT INTO "note" VALUES(1,1,1,1,14.5,'2026-01-12');
INSERT INTO "note" VALUES(2,1,2,2,16.0,'2026-01-14');
INSERT INTO "note" VALUES(3,1,3,3,15.0,'2026-01-15');
INSERT INTO "note" VALUES(4,2,1,1,17.0,'2026-01-12');
INSERT INTO "note" VALUES(5,2,2,2,12.5,'2026-01-14');
INSERT INTO "note" VALUES(6,3,1,1,9.0,'2026-01-12');
INSERT INTO "note" VALUES(7,3,4,NULL,13.0,'2026-01-13');
INSERT INTO "note" VALUES(8,4,2,2,18.5,'2026-01-14');
INSERT INTO "note" VALUES(9,5,1,1,11.0,'2026-01-12');
INSERT INTO "note" VALUES(10,5,3,3,11.8,'2026-01-15');
CREATE TABLE professeur (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT NOT NULL,
            prenom TEXT NOT NULL,
            specialite TEXT
        );
INSERT INTO "professeur" VALUES(1,'Abdellah','Yassine','Mathematique');
INSERT INTO "professeur" VALUES(2,'Bounou','Samira','Programmation PHP');
INSERT INTO "professeur" VALUES(3,'Lahlou','Karim','Bases de donnees');
CREATE INDEX idx_note_etudiant ON note (etudiant_id);
DELETE FROM "sqlite_sequence";
INSERT INTO "sqlite_sequence" VALUES('professeur',3);
INSERT INTO "sqlite_sequence" VALUES('matiere',4);
INSERT INTO "sqlite_sequence" VALUES('etudiant',5);
INSERT INTO "sqlite_sequence" VALUES('note',10);
COMMIT;
