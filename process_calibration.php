<?php
// Chemin vers le fichier texte
$file = 'document.txt';

// Vérifier si le fichier existe
if (!file_exists($file)) {
    echo json_encode(['error' => 'Le fichier n\'existe pas']);
    exit;
}

// Lire le contenu du fichier texte
$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$total = 0;

foreach ($lines as $line) {
    // Extraire le premier et le dernier chiffre de chaque ligne
    preg_match('/\d/', $line, $firstMatch);  // Premier chiffre
    preg_match('/\d(?!.*\d)/', $line, $lastMatch);  // Dernier chiffre

    // Si un premier et dernier chiffre sont trouvés, les combiner et les additionner
    if (isset($firstMatch[0]) && isset($lastMatch[0])) {
        $value = intval($firstMatch[0] . $lastMatch[0]);  // Combinaison des chiffres
        $total += $value;  // Ajouter à la somme totale
    }
}

// Retourner la somme totale sous forme de JSON
header('Content-Type: application/json');
echo json_encode(['result' => $total]);
?>
