<?php
// include "getUsers.php";
// include "script.js"
/* Fonctionnement SPA / API:
SPA: (Single Page Application) est une application web qui fonctionne en chargeant une seule page HTML dans le navigateur et en utilisant JavaScript pour gérer les interactions avec l'utilisateur.

API: (Application Programming Interface) est un programme qui permet à deux applications distinctes de communiquer entre elles via un échange de données. 
Elle agit comme une interface qui simplifie l'interaction entre différents systèmes, sans nécessiter une connaissance approfondie de leur fonctionnement interne.
*/
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Formulaire</title>
        
        <link rel="stylesheet" href="style.css">
    <body>
        <header>
            <nav>
                <h1>ContactFlow</h1>
                <!-- <br><br> -->
        <!-- <a href="/Index" class="route">Index</a> -->
        <a href="/Contact" class="route">Contact</a>
        <a href="/Favoris" class="route">Favoris</a>
        <a href="/Exporter CSV" class="route">Exporter CSV</a>
        <!-- <br><br> -->
         <div>
        <button class="contact">Créer un Contact</button>
        </div>
        <!-- <br><br> -->
    </nav>
        </header>
        <div>
            <!-- <form class="rechercher" method="GET" action="rechercher.php">
            <input type="text" placeholder="Rechercher">
            <button type="submit">Q</button>
            <span class="icone-loupe" type="submit"></span>
        </form> -->
    <!-- <input type="text" style="border-radius:16px;" placeholder="Rechercher un contact...">
    <a href="#">
        <i class="fas fa-search"></i> 
    </a> -->
</div>
        <input type="text" name="recherche" id="search" placeholder="Rechercher un contact...">
        <div id="container"></div>
        <!-- <input type="text" id="search" placeholder="Rechercher..." autocomplete="off">
        <ul id="suggestions"></ul> -->
        </form>
        <form id="form">
            <input type="text" id="prenom" placeholder="Prénom" required>
            <br><br>
            <input type="text" id="nom" placeholder="Nom" required>
            <br><br>
            <input type="number" id="telephone" placeholder="Téléphone" required>
            <br><br>
            <input type="email" id="email" placeholder="Email" required>
            <br><br>
            <input type="text" id="adresse" placeholder="Adresse" required>
            <br><br>
            <button type="submit">Envoyer</button>
        </form>
        
        <p id="message"></p>
        <div id="container">
            <button class="modifier">
            <img src="./Images/CrayonPapierBleu.webp" alt="logo stylo" width="30px" height="30px">
            </button>
            <button class="supprimer">
            <img src="./Images/PoubelleRouge.webp" alt="logo poubelle" width=30px height="30px">
           </button>
        </div>
        <!--Pagination JS-->
        <!-- <button id="prev">Précédent</button>
        <button id="next">Suivant</button>
        <p id="pageInfo"></p> -->
        <div id="app"></div>
        <script src="script.js"></script>
        <!-- <script src="app.js"></script> -->
        </body> 
        </html>