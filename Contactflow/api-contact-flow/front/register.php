<?php

require "../include/config.php";

if (isset($_POST["submit"])) {
    if (!empty($_POST["username"] && (!empty($_POST["password"])))) {
$sql = "INSERT INTO utilisateurs (username, password) VALUES (:username, :password) ";
$query = $pdo -> prepare($sql);
$query->execute([':login' => $_POST["login"], ':mdp' => password_hash($_POST["mdp"], PASSWORD_DEFAULT), ':prenom' => $_POST["prenom"], ':nom' => $_POST["nom"]]);
echo "Compte crée";
header("Location: index.php");
}  
else if (empty($_POST["username"]) or (!empty($_POST["password"]))) {
    echo "Formulaire incomplet";
}
else {
    echo "Formulaire non transmis";
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>

    </header>
    <form action="" method="POST">
        <input type="text" name="username" id="username" placeholder="Nom d'utilisateur">
        <input type="password" name="password" id="password" placeholder="Mot de passe">
        <input type="submit" name="submit" id="submit">
    </form>
</body>
</html>