<?php

header("Content-Type: application/json");

try {
    $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");

    $stmt = $pdo->prepare("SELECT * FROM users ORDER BY prenom");
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);

} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
}

// header("Content-Type: application/json");

// $query = $_GET['q'] ?? '';

// try {
//     $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");

//     $stmt = $pdo->prepare("
//         SELECT id, prenom, nom 
//         FROM users 
//         WHERE prenom LIKE :q OR nom LIKE :q 
//         LIMIT 5
//     ");

//     $stmt->execute(['q' => "%$query%"]);
//     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     echo json_encode($results);

// } catch (PDOException $e) {
//     echo json_encode(["error" => $e->getMessage()]);
// }

// <?php
// header("Content-Type: application/json");

// $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
// $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

// try {
//     $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");

//     // récupérer les users paginés
//     $stmt = $pdo->prepare("SELECT * FROM users LIMIT :limit OFFSET :offset");
//     $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
//     $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
//     $stmt->execute();

//     $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // total pour pagination
//     $total = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

//     echo json_encode([
//         "data" => $users,
//         "total" => (int)$total
//     ]);

// } catch (PDOException $e) {
//     echo json_encode(["error" => $e->getMessage()]);
// }