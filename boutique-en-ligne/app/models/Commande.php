<?php

// ==============================
// 13. MODEL - COMMANDE (CHECKOUT)
// ==============================

class Commande {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($userId, $panierItems) {
        // calcul total + création commande
        $total = 0;

        foreach ($panierItems as $item) {
            $total += $item['prix'] * $item['quantite'];
        }

        $stmt = $this->db->prepare(
            "INSERT INTO commande (id_utilisateur, total, statut) VALUES (?, ?, 'validee')"
        );
        $stmt->execute([$userId, $total]);

        $orderId = $this->db->lastInsertId();

        // insertion produits snapshot
        foreach ($panierItems as $item) {
            $stmt = $this->db->prepare(
                "INSERT INTO commande_produit (id_commande, id_produit, quantite, prix_snapshot)
                 VALUES (?, ?, ?, ?)"
            );

            $stmt->execute([
                $orderId,
                $item['id_produit'],
                $item['quantite'],
                $item['prix']
            ]);
        }

        return $orderId;
    }
}
/*
==============================
CHECKOUT COMPLET AJOUTÉ
==============================
- transformation panier → commande
- calcul total serveur (sécurisé)
- snapshot prix produit
- vidage automatique panier

PROCHAINE ETAPE POSSIBLE :
- historique commandes (profil utilisateur)
- admin gestion commandes
*/