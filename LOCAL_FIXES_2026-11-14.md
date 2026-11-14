# Corrections locales du 14 novembre 2026

Les modifications pr?existantes des cours JavaScript et C++ ont ?t? conserv?es.

Corrections : syntaxe et helpers Oracle, options de quiz Oracle, conventions Vrai/Faux, attente des r?sultats asynchrones et v?rification de la source des messages du runner, parenth?ses des consignes dans lesson.js, r?glages JSON null, note absente renvoy?e en 404, validation compl?te des r?glages avant ?criture, d?couverte des six projets, chemin temporaire portable, restrictions Apache et validateurs de contenu/exercices.

V?rifications : aucune erreur de syntaxe PHP dans le p?rim?tre applicatif ; syntaxe des neuf scripts JavaScript valide ; 146/146 le?ons chargeables ; six projets ; 119 tests PHP et 123 tests SQL sans ?chec ; tests de r?gression persistence et runner r?ussis. Le validateur parcourt 311 fichiers sans erreur structurelle, avec 47 avertissements de textes courts ou traductions manquantes. Les sondes de persistance sont annul?es par rollback.

HTTP localhost : accueil, bootstrap, projets, r?glages et informations SQL r?pondent ; les ex?cuteurs PHP et SQLite renvoient 42. Le serveur existant est actif sur http://127.0.0.1:8088/ avec public/ comme racine.

Limites : pas de v?rification visuelle dans un navigateur, ni de test Apache ou MySQL. Oracle reste en mode lecture. Une boucle JavaScript synchrone peut bloquer le thread du navigateur : le timeout du runner couvre les attentes asynchrones et ne garantit pas une interruption des boucles synchrones. Les copies dist et archives de d?ploiement sont conserv?es telles quelles ; les corrections concernent l?application PHP active.
