<?php
// ==============================
// 5. CONTROLLER - PRODUCT
// ==============================

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new Product();
    }

    public function index() {
        header('Content-Type: application/json');
        echo json_encode($this->model->getAll());
    }

    public function show() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID manquant']);
            return;
        }

        header('Content-Type: application/json');
        echo json_encode($this->model->getById($id));
    }
}