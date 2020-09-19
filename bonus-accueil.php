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
    <form id="form" method="GET" action="bonus-resultat.php">
        <p class="texte"> Durée de la location (en jours): 
            <input id="myInput" type="number" name="jours" min="1" max="30" value="1" title="Inscrire un nombre entier entre 1 et 30." 
            pattern="[0-9]+" oninput="changeBackgroundJours()" required autofocus />
        </p>
        <p>Catégorie:
        <select  name="outil" id="outils" onchange="changeBackgroundOutil()" > 
                <option value="A" name="outil"><span>A</span>: Léger</option>
                <option value="W" name="outil"><span>W</span>: Lourd</option>
                <option value="P" name="outil"><span>P</span>: Professionnel</option>
        </select>
        </p>
        <p>
            <button type="submit" name="estimer" value="Submit">Estimer</button>
            <button type="button" onclick="alea()">Random</button>
            <button type="reset">Reset</button>
        </p>
    </form>
    <script>
        function alea(){
            let dropvaluesArray = ['A','W','P'];

            form.jours.value = random(+form.jours.min, +form.jours.max);
            form.outil.value = dropvaluesArray[random(0,2)];

            changeBackgroundJours(); 
            changeBackgroundOutil() ;
        }

        function random(min, max) {
            return Math.trunc(Math.random()*(max-min+1)) + min;
        }
         
        function changeBackgroundJours() {
            const RGB_DIMINUE = 6;
            let jours = myInput.value;
            let bleu = (255 + RGB_DIMINUE) - jours * RGB_DIMINUE;

            myInput.style.backgroundColor = "rgb(0, 255, " + bleu + ")";
        }
    

        function changeBackgroundOutil() {     
            let typeOutil = form.outil.value; 

            if(typeOutil === 'A')
            {
                outils.style.backgroundColor = "violet"; 
            } 
            else if(typeOutil === "W")
            {
                outils.style.backgroundColor = "orange"; 
            }
            else
            {
                outils.style.backgroundColor = "red";
            }
        }
    </script>
</body>
</html>