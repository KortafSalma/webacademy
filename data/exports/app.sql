BEGIN TRANSACTION;
CREATE TABLE bookmarks (
    lesson_key TEXT PRIMARY KEY,
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE exercise_results (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    lesson_key TEXT NOT NULL,
    level      INTEGER NOT NULL,
    passed     INTEGER NOT NULL DEFAULT 0,
    tries      INTEGER NOT NULL DEFAULT 0,
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE history (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    lesson_key TEXT NOT NULL,
    viewed_at  TEXT NOT NULL DEFAULT (datetime('now'))
);
INSERT INTO "history" VALUES(1,'html-ch1','2026-11-06 20:30:46');
INSERT INTO "history" VALUES(2,'html-ch1','2026-11-06 20:44:57');
INSERT INTO "history" VALUES(3,'integration-ch2','2026-11-06 20:49:14');
INSERT INTO "history" VALUES(4,'php-ch9','2026-11-06 20:49:14');
INSERT INTO "history" VALUES(5,'integration-ch1','2026-11-06 20:49:14');
INSERT INTO "history" VALUES(6,'html-ch1','2026-11-07 11:31:35');
INSERT INTO "history" VALUES(7,'html-ch1','2026-11-07 11:32:49');
INSERT INTO "history" VALUES(8,'html-ch1','2026-11-07 11:40:02');
INSERT INTO "history" VALUES(9,'html-ch1','2026-11-07 20:48:45');
INSERT INTO "history" VALUES(10,'html-ch1','2026-11-07 21:06:13');
INSERT INTO "history" VALUES(11,'html-ch1','2026-11-07 21:06:19');
INSERT INTO "history" VALUES(12,'html-ch1','2026-11-07 21:06:29');
INSERT INTO "history" VALUES(13,'html-ch1','2026-11-07 21:06:35');
INSERT INTO "history" VALUES(14,'html-ch1','2026-11-07 21:09:11');
INSERT INTO "history" VALUES(15,'html-ch1','2026-11-07 21:09:17');
INSERT INTO "history" VALUES(16,'html-ch1','2026-11-07 21:09:38');
INSERT INTO "history" VALUES(17,'html-ch1','2026-11-07 21:09:45');
INSERT INTO "history" VALUES(18,'html-ch3','2026-11-08 13:59:33');
INSERT INTO "history" VALUES(19,'html-ch1','2026-11-08 14:03:23');
INSERT INTO "history" VALUES(20,'html-ch1','2026-11-08 14:09:22');
INSERT INTO "history" VALUES(21,'css-ch8','2026-11-08 14:09:23');
INSERT INTO "history" VALUES(22,'php-ch1','2026-11-08 14:09:24');
INSERT INTO "history" VALUES(23,'sql-ch8','2026-11-08 14:09:25');
INSERT INTO "history" VALUES(24,'html-ch1','2026-11-08 14:11:15');
INSERT INTO "history" VALUES(25,'css-ch8','2026-11-08 14:11:15');
INSERT INTO "history" VALUES(26,'php-ch1','2026-11-08 14:11:16');
INSERT INTO "history" VALUES(27,'sql-ch8','2026-11-08 14:11:17');
INSERT INTO "history" VALUES(28,'html-ch1','2026-11-08 14:14:47');
INSERT INTO "history" VALUES(29,'css-ch8','2026-11-08 14:14:50');
INSERT INTO "history" VALUES(30,'php-ch1','2026-11-08 14:14:53');
INSERT INTO "history" VALUES(31,'sql-ch8','2026-11-08 14:14:56');
INSERT INTO "history" VALUES(32,'html-ch1','2026-11-08 14:15:35');
INSERT INTO "history" VALUES(33,'html-ch1','2026-11-08 14:15:43');
INSERT INTO "history" VALUES(34,'html-ch1','2026-11-08 14:15:51');
INSERT INTO "history" VALUES(35,'html-ch1','2026-11-08 14:16:10');
INSERT INTO "history" VALUES(36,'html-ch1','2026-11-08 14:16:27');
INSERT INTO "history" VALUES(37,'html-ch1','2026-11-08 14:16:37');
INSERT INTO "history" VALUES(38,'html-ch1','2026-11-08 14:16:58');
INSERT INTO "history" VALUES(39,'html-ch1','2026-11-08 14:18:03');
INSERT INTO "history" VALUES(40,'html-ch1','2026-11-08 14:18:21');
INSERT INTO "history" VALUES(41,'css-ch8','2026-11-08 14:18:24');
INSERT INTO "history" VALUES(42,'php-ch1','2026-11-08 14:18:27');
INSERT INTO "history" VALUES(43,'sql-ch8','2026-11-08 14:18:30');
INSERT INTO "history" VALUES(44,'html-ch1','2026-11-08 14:19:07');
INSERT INTO "history" VALUES(45,'html-ch1','2026-11-08 14:19:16');
INSERT INTO "history" VALUES(46,'html-ch1','2026-11-08 14:19:24');
INSERT INTO "history" VALUES(47,'html-ch1','2026-11-08 14:19:43');
INSERT INTO "history" VALUES(48,'html-ch1','2026-11-08 14:20:15');
INSERT INTO "history" VALUES(49,'css-ch8','2026-11-08 14:25:21');
INSERT INTO "history" VALUES(50,'sql-ch8','2026-11-08 14:25:24');
INSERT INTO "history" VALUES(51,'html-ch1','2026-11-08 14:25:29');
INSERT INTO "history" VALUES(52,'html-ch1','2026-11-08 14:25:37');
INSERT INTO "history" VALUES(53,'html-ch1','2026-11-08 14:36:27');
INSERT INTO "history" VALUES(54,'css-ch8','2026-11-08 14:36:31');
INSERT INTO "history" VALUES(55,'php-ch1','2026-11-08 14:36:35');
INSERT INTO "history" VALUES(56,'sql-ch8','2026-11-08 14:36:38');
INSERT INTO "history" VALUES(57,'html-ch1','2026-11-08 14:37:27');
INSERT INTO "history" VALUES(58,'html-ch1','2026-11-08 14:37:39');
INSERT INTO "history" VALUES(59,'html-ch1','2026-11-08 14:37:50');
INSERT INTO "history" VALUES(60,'html-ch1','2026-11-08 14:38:12');
INSERT INTO "history" VALUES(61,'html-ch1','2026-11-08 14:38:51');
INSERT INTO "history" VALUES(62,'css-ch8','2026-11-08 14:39:34');
INSERT INTO "history" VALUES(63,'sql-ch8','2026-11-08 14:39:38');
INSERT INTO "history" VALUES(64,'html-ch1','2026-11-08 14:39:40');
INSERT INTO "history" VALUES(65,'css-ch8','2026-11-08 14:39:59');
INSERT INTO "history" VALUES(66,'sql-ch8','2026-11-08 14:40:01');
INSERT INTO "history" VALUES(67,'html-ch1','2026-11-08 14:40:05');
INSERT INTO "history" VALUES(68,'css-ch8','2026-11-08 14:40:25');
INSERT INTO "history" VALUES(69,'sql-ch8','2026-11-08 14:40:28');
INSERT INTO "history" VALUES(70,'html-ch1','2026-11-08 14:40:32');
INSERT INTO "history" VALUES(71,'css-ch8','2026-11-08 14:40:50');
INSERT INTO "history" VALUES(72,'sql-ch8','2026-11-08 14:40:53');
INSERT INTO "history" VALUES(73,'html-ch1','2026-11-08 14:40:55');
INSERT INTO "history" VALUES(74,'html-ch3','2026-11-08 15:21:23');
INSERT INTO "history" VALUES(75,'html-ch3','2026-11-09 09:59:55');
INSERT INTO "history" VALUES(76,'html-ch6','2026-11-09 10:44:01');
INSERT INTO "history" VALUES(77,'html-ch1','2026-11-10 21:04:47');
INSERT INTO "history" VALUES(78,'css-ch8','2026-11-10 21:04:51');
INSERT INTO "history" VALUES(79,'php-ch1','2026-11-10 21:04:54');
INSERT INTO "history" VALUES(80,'sql-ch8','2026-11-10 21:04:57');
INSERT INTO "history" VALUES(81,'html-ch4','2026-11-10 21:05:28');
INSERT INTO "history" VALUES(82,'html-ch4','2026-11-10 21:05:58');
INSERT INTO "history" VALUES(83,'html-ch1','2026-11-10 21:06:55');
INSERT INTO "history" VALUES(84,'css-ch8','2026-11-10 21:06:58');
INSERT INTO "history" VALUES(85,'php-ch1','2026-11-10 21:07:01');
INSERT INTO "history" VALUES(86,'sql-ch8','2026-11-10 21:07:04');
INSERT INTO "history" VALUES(87,'html-ch1','2026-11-10 21:07:41');
INSERT INTO "history" VALUES(88,'html-ch1','2026-11-10 21:07:56');
INSERT INTO "history" VALUES(89,'html-ch1','2026-11-10 21:08:04');
INSERT INTO "history" VALUES(90,'html-ch1','2026-11-10 21:08:32');
INSERT INTO "history" VALUES(91,'html-ch1','2026-11-10 21:09:17');
INSERT INTO "history" VALUES(92,'html-ch1','2026-11-10 21:09:43');
INSERT INTO "history" VALUES(93,'css-ch8','2026-11-10 21:09:45');
INSERT INTO "history" VALUES(94,'sql-ch8','2026-11-10 21:09:48');
INSERT INTO "history" VALUES(95,'html-ch1','2026-11-10 21:09:54');
INSERT INTO "history" VALUES(96,'html-ch1','2026-11-10 21:10:02');
INSERT INTO "history" VALUES(97,'html-ch1','2026-11-10 21:10:56');
INSERT INTO "history" VALUES(98,'sql-ch8','2026-11-10 21:10:59');
INSERT INTO "history" VALUES(99,'php-ch1','2026-11-10 21:18:18');
INSERT INTO "history" VALUES(100,'php-ch1','2026-11-10 21:18:18');
INSERT INTO "history" VALUES(101,'html-ch3','2026-11-10 21:22:38');
INSERT INTO "history" VALUES(102,'php-ch4','2026-11-10 21:22:39');
INSERT INTO "history" VALUES(103,'sql-ch5','2026-11-10 21:22:39');
INSERT INTO "history" VALUES(104,'integration-ch2','2026-11-10 21:22:40');
INSERT INTO "history" VALUES(105,'cpp-ch1','2026-11-10 21:24:36');
INSERT INTO "history" VALUES(106,'javascript-ch1','2026-11-10 21:24:36');
INSERT INTO "history" VALUES(107,'javascript-ch1','2026-11-10 21:25:38');
INSERT INTO "history" VALUES(108,'javascript-ch1','2026-11-10 21:25:55');
INSERT INTO "history" VALUES(109,'javascript-ch1','2026-11-10 21:27:06');
INSERT INTO "history" VALUES(110,'cpp-ch1','2026-11-10 21:33:47');
INSERT INTO "history" VALUES(111,'cpp-ch1','2026-11-10 21:34:17');
INSERT INTO "history" VALUES(112,'cpp-ch1','2026-11-10 22:47:00');
INSERT INTO "history" VALUES(113,'javascript-ch1','2026-11-10 22:47:00');
INSERT INTO "history" VALUES(114,'cpp-ch1','2026-11-10 22:56:21');
INSERT INTO "history" VALUES(115,'javascript-ch1','2026-11-10 22:56:28');
INSERT INTO "history" VALUES(116,'html-ch1','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(117,'html-ch2','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(118,'html-ch3','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(119,'html-ch4','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(120,'html-ch5','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(121,'html-ch6','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(122,'html-ch7','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(123,'html-ch8','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(124,'css-ch1','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(125,'css-ch2','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(126,'css-ch3','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(127,'css-ch4','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(128,'css-ch5','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(129,'css-ch6','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(130,'css-ch7','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(131,'css-ch8','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(132,'css-ch9','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(133,'css-ch10','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(134,'css-ch11','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(135,'css-ch12','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(136,'css-ch13','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(137,'css-ch14','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(138,'php-ch1','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(139,'php-ch2','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(140,'php-ch3','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(141,'php-ch4','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(142,'php-ch5','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(143,'php-ch6','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(144,'php-ch7','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(145,'php-ch8','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(146,'php-ch9','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(147,'php-ch10','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(148,'php-ch11','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(149,'php-ch12','2026-11-14 13:58:20');
INSERT INTO "history" VALUES(150,'php-ch13','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(151,'php-ch14','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(152,'php-ch15','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(153,'sql-ch1','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(154,'sql-ch2','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(155,'sql-ch3','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(156,'sql-ch4','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(157,'sql-ch5','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(158,'sql-ch6','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(159,'sql-ch7','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(160,'sql-ch8','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(161,'sql-ch9','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(162,'sql-ch10','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(163,'sql-ch11','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(164,'sql-ch12','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(165,'sql-ch13','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(166,'sql-ch14','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(167,'integration-ch1','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(168,'integration-ch2','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(169,'integration-ch3','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(170,'integration-ch4','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(171,'integration-ch5','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(172,'integration-ch6','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(173,'integration-ch7','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(174,'cpp-ch1','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(175,'cpp-ch2','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(176,'cpp-ch3','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(177,'cpp-ch4','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(178,'cpp-ch5','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(179,'cpp-ch6','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(180,'cpp-ch7','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(181,'cpp-ch8','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(182,'cpp-ch9','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(183,'cpp-ch10','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(184,'cpp-ch11','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(185,'cpp-ch12','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(186,'cpp-ch13','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(187,'cpp-ch14','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(188,'cpp-ch15','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(189,'cpp-ch16','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(190,'cpp-ch17','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(191,'cpp-ch18','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(192,'cpp-ch19','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(193,'cpp-ch20','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(194,'cpp-ch21','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(195,'cpp-ch22','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(196,'cpp-ch23','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(197,'cpp-ch24','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(198,'cpp-ch25','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(199,'cpp-ch26','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(200,'cpp-ch27','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(201,'cpp-ch28','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(202,'cpp-ch29','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(203,'cpp-ch30','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(204,'javascript-ch1','2026-11-14 13:58:21');
INSERT INTO "history" VALUES(205,'javascript-ch2','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(206,'javascript-ch3','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(207,'javascript-ch4','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(208,'javascript-ch5','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(209,'javascript-ch6','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(210,'javascript-ch7','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(211,'javascript-ch8','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(212,'javascript-ch9','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(213,'javascript-ch10','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(214,'javascript-ch11','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(215,'javascript-ch12','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(216,'javascript-ch13','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(217,'javascript-ch14','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(218,'javascript-ch15','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(219,'javascript-ch16','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(220,'javascript-ch17','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(221,'javascript-ch18','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(222,'javascript-ch19','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(223,'javascript-ch20','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(224,'javascript-ch21','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(225,'javascript-ch22','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(226,'javascript-ch23','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(227,'javascript-ch24','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(228,'javascript-ch25','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(229,'javascript-ch26','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(230,'javascript-ch27','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(231,'javascript-ch28','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(232,'javascript-ch29','2026-11-14 13:58:22');
INSERT INTO "history" VALUES(233,'javascript-ch30','2026-11-14 13:58:22');
CREATE TABLE lab_snippets (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    module     TEXT NOT NULL,
    name       TEXT NOT NULL,
    code       TEXT NOT NULL,
    updated_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE notes (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    lesson_key TEXT,
    title      TEXT NOT NULL,
    body       TEXT NOT NULL,
    created_at TEXT NOT NULL DEFAULT (datetime('now')),
    updated_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE progress (
    lesson_key TEXT PRIMARY KEY,
    status     TEXT NOT NULL DEFAULT 'in_progress',
    score      INTEGER NOT NULL DEFAULT 0,
    updated_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE quiz_results (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    lesson_key TEXT NOT NULL,
    score      INTEGER NOT NULL,
    total      INTEGER NOT NULL,
    answers    TEXT NOT NULL DEFAULT '[]',
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
);
CREATE TABLE settings (
    key   TEXT PRIMARY KEY,
    value TEXT NOT NULL
);
INSERT INTO "settings" VALUES('langMode','"darija"');
INSERT INTO "settings" VALUES('lastLesson','"html-ch3"');
INSERT INTO "settings" VALUES('theme','"light"');
INSERT INTO "settings" VALUES('examMode','true');
CREATE INDEX idx_history_lesson ON history (lesson_key, viewed_at);
CREATE INDEX idx_quiz_lesson ON quiz_results (lesson_key, id);
CREATE INDEX idx_exercise_lesson ON exercise_results (lesson_key, level);
DELETE FROM "sqlite_sequence";
INSERT INTO "sqlite_sequence" VALUES('quiz_results',2);
INSERT INTO "sqlite_sequence" VALUES('exercise_results',1);
INSERT INTO "sqlite_sequence" VALUES('history',233);
INSERT INTO "sqlite_sequence" VALUES('notes',6);
COMMIT;
