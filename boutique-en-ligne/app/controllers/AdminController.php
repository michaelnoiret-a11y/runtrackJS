<?php

// ==============================
// 21. CONTROLLER - ADMIN
// ==============================

class AdminController {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = new AdminProduct();
        $this->categoryModel = new AdminCategory();
    }

    private function checkAdmin() {
        session_start();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Accès refusé']);
            exit;
        }
    }

    // PRODUITS
    public function addProduct() {
        $this->checkAdmin();
        $data = json_decode(file_get_contents("php://input"), true);

        $this->productModel->create(
            $data['nom'],
            $data['description'],
            $data['prix'],
            $data['stock'],
            $data['image'],
            $data['id_categorie']
        );

        echo json_encode(['message' => 'Produit ajouté']);
    }

    public function updateProduct() {
        $this->checkAdmin();
        $data = json_decode(file_get_contents("php://input"), true);

        $this->productModel->update(
            $data['id_produit'],
            $data['nom'],
            $data['description'],
            $data['prix'],
            $data['stock']
        );

        echo json_encode(['message' => 'Produit modifié']);
    }

    public function deleteProduct() {
        $this->checkAdmin();
        $data = json_decode(file_get_contents("php://input"), true);

        $this->productModel->delete($data['id_produit']);

        echo json_encode(['message' => 'Produit supprimé']);
    }

    // CATEGORIES
    public function addCategory() {
        $this->checkAdmin();
        $data = json_decode(file_get_contents("php://input"), true);

        $this->categoryModel->create($data['nom'], $data['id_parent'] ?? null);

        echo json_encode(['message' => 'Catégorie ajoutée']);
    }

    public function deleteCategory() {
        $this->checkAdmin();
        $data = json_decode(file_get_contents("php://input"), true);

        $this->categoryModel->delete($data['id_categorie']);

        echo json_encode(['message' => 'Catégorie supprimée']);
    }
}
