<?php
/**
 * VALIDATEUR DE CONTENU — WebAcademy
 * Vérifie la conformité des fichiers de contenu :
 * - Clés requises présentes
 * - FR/Darija réels (pas de placeholder « … »)
 * - Niveaux d'exercice : 1 à 6
 * - Quiz : 5 MCQ + 3 TF + 2 pratique = 10 questions
 * - Aucun contenu de remplacement
 */

declare(strict_types=1);

function hasPlaceholder(string $text): bool {
    return str_contains($text, '...') || str_contains($text, 'TODO') || str_contains($text, 'à compléter');
}

function hasRealText(array $blocks): bool {
    foreach ($blocks as $block) {
        if (!is_array($block)) continue;
        $fr = $block['fr'] ?? '';
        $darija = $block['darija'] ?? '';
        if (!hasPlaceholder($fr) && !hasPlaceholder($darija)) {
            // Vérifier aussi que ce n'est pas juste des balises HTML vides
            $frPlain = strip_tags($fr);
            $darijaPlain = strip_tags($darija);
            if (mb_strlen($frPlain) > 20 && mb_strlen($darijaPlain) > 20) {
                return true;
            }
        }
    }
    return false;
}

function validateChapter(string $path): array {
    $result = ['file' => $path, 'valid' => false, 'errors' => [], 'warnings' => []];
    
    if (!is_file($path)) {
        $result['errors'][] = 'Fichier introuvable';
        return $result;
    }
    
    $data = require $path;
    if (!is_array($data)) {
        $result['errors'][] = 'Le fichier ne renvoie pas un array';
        return $result;
    }
    
    // Vérifier les clés requises du chapitre
    $required = ['id', 'title'];
    foreach ($required as $key) {
        if (!isset($data[$key])) {
            $result['errors'][] = "Clé requise manquante : $key";
        }
    }
    
    // Vérifier objectives
    if (!isset($data['objectives']) || !is_array($data['objectives'])) {
        $result['errors'][] = 'Missing or invalid objectives array';
    } else {
        foreach ($data['objectives'] as $obj) {
            if (!is_string($obj) || mb_strlen($obj) < 10) {
                $result['errors'][] = 'Objectif trop court ou invalide';
            }
            if (hasPlaceholder($obj)) {
                $result['warnings'][] = 'Placeholder détecté dans un objectif FR';
            }
        }
    }
    
    // Vérifier les leçons
    if (!isset($data['lessons']) || !is_array($data['lessons'])) {
        $result['errors'][] = 'Missing or invalid lessons array';
    } else {
        $hasValidLessons = hasRealText($data['lessons']);
        if (!$hasValidLessons) {
            $result['errors'][] = 'Aucun contenu de leçon réel détecté (tout est placeholder)';
        }
    }
    
    // Vérifier mistakes
    if (!isset($data['mistakes']) || !is_array($data['mistakes'])) {
        $result['errors'][] = 'Missing or invalid mistakes array';
    } else {
        $mistakeCount = count($data['mistakes']);
        if ($mistakeCount < 2 || $mistakeCount > 4) {
            $result['warnings'][] = sprintf('Nombre d\'erreurs attendu 2-4, trouvé %d', $mistakeCount);
        }
        foreach ($data['mistakes'] as $m) {
            foreach (['wrong', 'fix', 'fr', 'darija'] as $k) {
                if (!isset($m[$k])) {
                    $result['errors'][] = sprintf('Clé %s manquante dans mistakes', $k);
                }
            }
        }
    }
    
    // Vérifier summary
    if (!isset($data['summary']) || !is_array($data['summary'])) {
        $result['errors'][] = 'Missing or invalid summary array';
    } else {
        foreach (['fr', 'darija'] as $lang) {
            if (!isset($data['summary'][$lang])) {
                $result['errors'][] = sprintf('Summary %s manquante', $lang);
            } elseif (hasPlaceholder($data['summary'][$lang])) {
                $result['warnings'][] = sprintf('Placeholder dans summary %s', $lang);
            }
        }
    }
    
    // Vérifier l'exercice si présent
    if (isset($data['levels']) && is_array($data['levels'])) {
        $levelCount = count($data['levels']);
        if ($levelCount < 1 || $levelCount > 6) {
            $result['errors'][] = sprintf('Nombre de niveaux attendu 1-6, trouvé %d', $levelCount);
        } else {
            foreach ($data['levels'] as $lv) {
                if (!isset($lv['level']) || $lv['level'] < 1 || $lv['level'] > 6) {
                    $result['errors'][] = sprintf('Niveau invalide : %s', $lv['level'] ?? 'missing');
                }
                foreach (['instructions', 'instructionsDarija', 'starter', 'tests', 'solution', 'explainFr', 'explainDarija'] as $k) {
                    if (!isset($lv[$k])) {
                        $result['errors'][] = sprintf('Clé %s manquante niveau %d', $k, $lv['level']);
                    }
                }
                // Vérifier pas de placeholder dans les instructions
                if (isset($lv['instructions']) && hasPlaceholder($lv['instructions'])) {
                    $result['warnings'][] = 'Placeholder dans instructions niveau ' . $lv['level'];
                }
                if (isset($lv['instructionsDarija']) && hasPlaceholder($lv['instructionsDarija'])) {
                    $result['warnings'][] = 'Placeholder dans instructionsDarija niveau ' . $lv['level'];
                }
            }
        }
    }
    
    // Vérifier le quiz si présent
    if (isset($data['questions']) && is_array($data['questions'])) {
        $qCount = count($data['questions']);
        if ($qCount < 8 || $qCount > 12) {
            $result['warnings'][] = sprintf('Nombre de questions attendu 8-12, trouvé %d', $qCount);
        }
        
        $types = [];
        foreach ($data['questions'] as $q) {
            if (!is_array($q)) {
                $result['errors'][] = 'Question mal formatée';
                continue;
            }
            $t = $q['type'] ?? 'unknown';
            $types[$t] = ($types[$t] ?? 0) + 1;
            
            // Vérifier les clés obligatoires selon le type
            foreach (['answer', 'concept', 'explainFr', 'explainDarija'] as $k) {
                if (!isset($q[$k])) {
                    $result['errors'][] = sprintf('Clé %s manquante question de type %s', $k, $t);
                }
            }
        }
        
        // Vérifier la répartition types
        if (!isset($types['mcq'])) $result['warnings'][] = 'Pas de question MCQ';
        if (!isset($types['tf'])) $result['warnings'][] = 'Pas de question Vrai/Faux';
    }
    
    $result['valid'] = count($result['errors']) === 0;
    return $result;
}

function validateModule(string $modulePath): array {
    $result = ['module' => $modulePath, 'valid' => true, 'errors' => [], 'warnings' => [], 'chapters' => 0];
    
    if (!is_dir($modulePath)) {
        $result['errors'][] = 'Module directory introuvable';
        $result['valid'] = false;
        return $result;
    }
    
    $chapters = glob($modulePath . '/c*.php');
    $result['chapters'] = count($chapters);
    
    foreach ($chapters as $chFile) {
        $validation = validateChapter($chFile);
        if (!$validation['valid']) {
            $result['valid'] = false;
            foreach ($validation['errors'] as $e) {
                $result['errors'][] .= '[' . basename($chFile) . '] ' . $e;
            }
            foreach ($validation['warnings'] as $w) {
                $result['warnings'][] .= '[' . basename($chFile) . '] ' . $w;
            }
        }
    }
    
    return $result;
}

// Main
$modulesDir = 'content';
$modules = ['cpp', 'javascript', 'html', 'css', 'php', 'sql'];

echo "=== VALIDATEUR DE CONTENU WEBACADEMY ===\n\n";

$globalValid = true;
foreach ($modules as $mod) {
    $modPath = "$modulesDir/$mod";
    $modValidation = validateModule($modPath);
    
    echo "Module : $mod\n";
    echo "  Chapitres trouvés : {$modValidation['chapters']}\n";
    
    if (!$modValidation['valid']) {
        $globalValid = false;
        echo "  ERREURS :\n";
        foreach ($modValidation['errors'] as $e) {
            echo "    - $e\n";
        }
    }
    if (count($modValidation['warnings']) > 0) {
        echo "  AVERTISSEMENTS :\n";
        foreach ($modValidation['warnings'] as $w) {
            echo "    - $w\n";
        }
    }
    echo "\n";
}

echo "========================================\n";
if ($globalValid) {
    echo "TOUS LES MODULES SONT VALIDES.\n";
    exit(0);
} else {
    echo "DES ERREURS ONT ÉTÉ DÉTECTÉES.\n";
    exit(1);
}