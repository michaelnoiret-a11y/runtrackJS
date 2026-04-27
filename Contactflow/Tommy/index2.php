<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Contact Flow</title>
</head>
<body style="background-color: #f0f0f0;">
    <main>
        <form id="form">
            <div>
            <div class="flex flex-col mt-25 mb-3 mr-180 bg-gray-200">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom">
            </div>

            <div class="flex flex-col mb-3 mr-180 bg-gray-200">
                <label for="Nom">Nom :</label>
                <input type="text" id="nom" name="nom">
            </div>
            <div class="flex flex-col mb-3 mr-180 bg-gray-200">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email">
            </div>

            <div class="flex flex-col mb-3 mr-180 bg-gray-200">
                <label for="tel">Numéro de Téléphone :</label>
                <input type="tel" id="tel" name="tel">
            </div>

            <input type="submit" value="Ajouter un contact" class="flex flex-col mt-5 mr-180 border bg-purple-500 hover:bg-purple-600 active:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </main>
    <script src="script2.js"></script>
</body>
</html>