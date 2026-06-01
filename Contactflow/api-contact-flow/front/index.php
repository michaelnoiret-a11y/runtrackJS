<?php
require "../include/config.php";

if (isset($_POST["submit"])) {
    if (!empty($_POST["username"] || (!empty($_POST["password"] )))) {
$sql = "SELECT * FROM utilisateurs WHERE username = :username ";
$query = $pdo -> prepare($sql);
$result = $query->execute([':username' => ($_POST['username'])]);
$result = $query->fetch(PDO::FETCH_ASSOC);

 if ($result && password_verify($_POST["password"], $result['password'])) {
        echo "Identifiants correct";
        var_dump($result["login"]);
        
            $_SESSION['user'] = $result;
            $_SESSION["username"] = $result["username"];
            $_SESSION["password"] = $result["password"];

        if ($result["login"] == "admin" ) {
            header("Location: admin.php");
            exit;

        }else{
      
        header("Location: profil.php");
        exit;
        }
    
    } else {
        echo "Mot de passe n'est pas correct";
    }
}
else {
    echo "Identifiants incorrects";
}
}

?>

    <form action="" method="POST">
        <br>
        <input type="text" name="username" id="username" placeholder="*Nom d'utilisateur" required>
        <br>
        <br>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        <br>
        <br>
        <input type="submit" name="submit" id="submit">
    </form>
</body>
</html>