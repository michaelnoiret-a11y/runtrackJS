<?php

// ==============================
// 17. CONTROLLER - HISTORIQUE
// ==============================

class HistoriqueController {
    private $model;

    public function __construct() {
        $this->model = new Historique();
    }

    public function getOrders() {
        session_start();

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Non connecté']);
            return;
        }

        $orders = $this->model->getUserOrders($userId);

        echo json_encode($orders);
    }

    public function getOrder() {
        session_start();

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Non connecté']);
            return;
        }

        $orderId = $_GET['id'] ?? null;

        if (!$orderId) {
            http_response_code(400);
            echo json_encode(['error' => 'ID commande manquant']);
            return;
        }

        $details = $this->model->getOrderDetails($orderId);

        echo json_encode($details);
    }
}