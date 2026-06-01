<?php

// Lire les données JSON envoyées
$data = json_decode(file_get_contents("php://input"), true);

$prenom = $data["prenom"];
$nom = $data["nom"];
$telephone = $data["telephone"];
$email = $data["email"];
$adresse = $data["adresse"];

try {
    // Connexion BDD (à adapter)
    $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");

    // Requête SQL
    $stmt = $pdo->prepare("INSERT INTO users (prenom, nom, telephone, email, adresse ) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$prenom, $nom, $telephone, $email, $adresse]);

    echo json_encode([
        "message" => "Utilisateur enregistré !"
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "message" => "Erreur : " . $e->getMessage()
    ]);
}