<?php

// ==============================
// 16. MODEL - HISTORIQUE COMMANDES
// ==============================

class Historique {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getUserOrders($userId) {
        $stmt = $this->db->prepare(
            "SELECT * FROM commande WHERE id_utilisateur = ? ORDER BY date_commande DESC"
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($orderId) {
        $stmt = $this->db->prepare(
            "SELECT cp.*, p.nom 
             FROM commande_produit cp
             JOIN produit p ON cp.id_produit = p.id_produit
             WHERE cp.id_commande = ?"
        );
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}