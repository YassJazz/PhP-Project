<?php

const TITRE = "Location d'outils Le Génie inc.";

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
    <h2>Estimateur de prix de location</h2>
    <p class="texte">
        SVP, veuillez indiquer la durée de la location en jours et appuyer sur le bouton qui correspond au type d'outil:
    </p>
    <form id="form" method="get" action="resultat.php">
        <p class="texte"> Durée de la location (en jours): 
            <input type="number" name="jours" min="1" max="30" value="1" title="Inscrire un nombre entier entre 1 et 30." 
                    pattern="[0-9]+" required autofocus> 
            <button type="button" onclick="joursAlea()">Random</button>
            <button type="reset">Reset</button>
        </p>
        <p class="outil">
            <button type="submit" name="outil" value="A"><span>A</span>: Léger</button>
            <button type="submit" name="outil" value="W"><span>W</span>: Lourd</button>
            <button type="submit" name="outil" value="P"><span>P</span>: Professionnel</button>
        </p>
    </form>
    <script>
        function joursAlea(){
            form.jours.value = random(+form.jours.min, +form.jours.max);
        }
        function random(min, max) {
            return Math.trunc(Math.random()*(max-min+1)) + min;
        }
    </script>
</body>
</html>