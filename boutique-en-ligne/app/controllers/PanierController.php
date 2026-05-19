<?php

// ==============================
// 11. CONTROLLER - PANIER
// ==============================

class PanierController {
    private $model;

    public function __construct() {
        $this->model = new Panier();
    }

    public function getCart() {
        session_start();

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Non connecté']);
            return;
        }

        $panier = $this->model->createIfNotExists($userId);
        $items = $this->model->getItems($panier['id_panier']);

        echo json_encode([
            'panier' => $panier,
            'items' => $items
        ]);
    }

    public function add() {
        session_start();

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Non connecté']);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        $panier = $this->model->createIfNotExists($userId);

        $this->model->addProduct(
            $panier['id_panier'],
            $data['id_produit'],
            $data['quantite'] ?? 1
        );

        echo json_encode(['message' => 'Produit ajouté au panier']);
    }

    public function remove() {
        session_start();

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Non connecté']);
            return;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        $panier = $this->model->getByUser($userId);

        $this->model->removeProduct(
            $panier['id_panier'],
            $data['id_produit']
        );

        echo json_encode(['message' => 'Produit supprimé du panier']);
    }
}