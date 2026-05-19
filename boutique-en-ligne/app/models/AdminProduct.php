<?php

// ==============================
// 19. MODEL - ADMIN PRODUIT
// ==============================

class AdminProduct {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($nom, $description, $prix, $stock, $image, $categorieId) {
        $stmt = $this->db->prepare(
            "INSERT INTO produit (nom, description, prix, stock, image, id_categorie)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$nom, $description, $prix, $stock, $image, $categorieId]);
    }

    public function update($id, $nom, $description, $prix, $stock) {
        $stmt = $this->db->prepare(
            "UPDATE produit SET nom=?, description=?, prix=?, stock=? WHERE id_produit=?"
        );
        return $stmt->execute([$nom, $description, $prix, $stock, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM produit WHERE id_produit=?");
        return $stmt->execute([$id]);
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM produit")->fetchAll(PDO::FETCH_ASSOC);
    }
}
