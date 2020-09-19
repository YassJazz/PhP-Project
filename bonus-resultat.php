<?php
const TITRE = "Location d'outils Le Génie inc.";
const PRIX_A = 15.50;
const PRIX_W = 42;
const PRIX_P = 50;
const PRIX_DEPASSE = 200;

$jours = 1;
if (is_numeric($_GET['jours'] ?? 1)) {
    $jours_entier = intval(+($_GET['jours'] ?? 1));
    $jours = minmax($jours_entier, 1, 30);  
}

$s = "jours";
if ($jours <= 1) {
    $s = "jour";
}

$outil = correction_texte($_GET['outil'] ?? 'A'); 
if ($outil <> "A" && $outil <> "W" && $outil <> "P") {
    $outil = "A";
}

$rabais = 0;
$phrase_rabais = calculPrixRabais($jours, $outil, $rabais);

function calculPrixRabais(int $jours, string $outil, float $rabais) {
    if ($outil === 'A') {
        $prix = PRIX_A * $jours;
        $phrase_rabais = ' <span class="rectangle"> ' . number_format(($prix), 2) . '$</span>.';    
    }
    else if($outil === 'W') {
        if ($jours > 3) {
            $prix = PRIX_W * $jours * 0.80; 
            $rabais = PRIX_W * $jours * 0.20;
            $phrase_rabais = ' <span class="rectangle"> ' . number_format(($prix), 2) . ' $</span>, une économie de <span class = "rectangle">' . number_format(($rabais), 2) . '$</span> sur le prix régulier.';
        }
        else {
            $prix = PRIX_W * $jours; 
            $phrase_rabais = ' <span class="rectangle"> ' . number_format(($prix), 2) . '$</span>.';
        }
    }
    else {
        if ($jours > 3) {
            $prix = PRIX_P * $jours * 0.80;
            $rabais = PRIX_P * $jours * 0.20;
            $phrase_rabais = ' <span class="rectangle"> ' . number_format(($prix), 2) . '$</span>, une économie de <span class = "rectangle">' . number_format(($rabais), 2) . '$</span> sur le prix régulier.';
        }
        else {
            $prix = PRIX_P * $jours;
            $phrase_rabais = ' <span class="rectangle"> ' . number_format(($prix), 2) . '$</span>.';
        } 
    }

    if ($prix >= PRIX_DEPASSE) {
        $rabais = $rabais + $prix * 0.05;
        $prix = $prix * 0.95;  
        $phrase_rabais = ' <span class="rectangle"> ' . number_format(($prix), 2) . '$</span>, une économie de <span class = "rectangle">' . number_format(($rabais), 2) . '$</span> sur le prix régulier.';
    }

    return $phrase_rabais;
}

function correction_texte(string $texte) {
    $texte = trim($texte);
    $texte = stripslashes($texte);
    $texte = htmlspecialchars($texte);
    return $texte;
}

function minmax($valeur, $min, $max) {
    return min(max($valeur, $min), $max);
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= TITRE ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?= TITRE ?></h1>
    <h2>Estimation</h2>
    <p class="texte">
        Pour la location d'un outil de catégorie <span class="rectangle"><?= $outil ?></span> pendant
        <span class="rectangle"><?= $jours ?></span> <?= $s ?>, le coût total de la location <span class="souligne">avant taxes</span>
        sera<?= $phrase_rabais ?>
    </p>
    <a href="javascript:history.go(-1)">Modifier</a>
    <a href="bonus-accueil.php">Nouvelle estimation</a>
</body>
</html>




