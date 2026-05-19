<?php

// ==============================
// 10. MODEL - PANIER
// ==============================

class Panier {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getByUser($userId) {
        $stmt = $this->db->prepare("SELECT * FROM panier WHERE id_utilisateur = ? AND statut = 'actif'");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createIfNotExists($userId) {
        $panier = $this->getByUser($userId);

        if ($panier) return $panier;

        $stmt = $this->db->prepare("INSERT INTO panier (id_utilisateur, statut) VALUES (?, 'actif')");
        $stmt->execute([$userId]);

        return $this->getByUser($userId);
    }

    public function addProduct($panierId, $productId, $quantity) {
        $stmt = $this->db->prepare("SELECT * FROM panier_produit WHERE id_panier = ? AND id_produit = ?");
        $stmt->execute([$panierId, $productId]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $stmt = $this->db->prepare("UPDATE panier_produit SET quantite = quantite + ? WHERE id_panier = ? AND id_produit = ?");
            return $stmt->execute([$quantity, $panierId, $productId]);
        }

        $stmt = $this->db->prepare("INSERT INTO panier_produit (id_panier, id_produit, quantite) VALUES (?, ?, ?)");
        return $stmt->execute([$panierId, $productId, $quantity]);
    }

    public function getItems($panierId) {
        $stmt = $this->db->prepare(
            "SELECT pp.*, p.nom, p.prix, p.image 
             FROM panier_produit pp
             JOIN produit p ON pp.id_produit = p.id_produit
             WHERE pp.id_panier = ?"
        );
        $stmt->execute([$panierId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeProduct($panierId, $productId) {
        $stmt = $this->db->prepare("DELETE FROM panier_produit WHERE id_panier = ? AND id_produit = ?");
        return $stmt->execute([$panierId, $productId]);
    }
}

/*
==============================
PANIER FONCTIONNEL AJOUTÉ
==============================
- panier lié à utilisateur connecté
- ajout produit (quantité gérée)
- suppression produit
- jointure produit pour affichage front

PROCHAINE ETAPE LOGIQUE :
- validation commande (checkout)
- calcul total automatique
*/