<?php

// ==============================
// 14. CONTROLLER - CHECKOUT
// ==============================

class CommandeController {
    private $commandeModel;
    private $panierModel;

    public function __construct() {
        $this->commandeModel = new Commande();
        $this->panierModel = new Panier();
    }

    public function checkout() {
        session_start();

        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Non connecté']);
            return;
        }

        $panier = $this->panierModel->createIfNotExists($userId);
        $items = $this->panierModel->getItems($panier['id_panier']);

        if (empty($items)) {
            http_response_code(400);
            echo json_encode(['error' => 'Panier vide']);
            return;
        }

        $orderId = $this->commandeModel->create($userId, $items);

        // vider panier
        $stmt = Database::getInstance()->getConnection()
            ->prepare("DELETE FROM panier_produit WHERE id_panier = ?");
        $stmt->execute([$panier['id_panier']]);

        echo json_encode([
            'message' => 'Commande validée',
            'order_id' => $orderId
        ]);
    }
}