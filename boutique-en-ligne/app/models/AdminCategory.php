<?php

// ==============================
// 20. MODEL - ADMIN CATEGORIE
// ==============================

class AdminCategory {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($nom, $parentId = null) {
        $stmt = $this->db->prepare(
            "INSERT INTO categorie (nom, id_parent) VALUES (?, ?)"
        );
        return $stmt->execute([$nom, $parentId]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categorie WHERE id_categorie=?");
        return $stmt->execute([$id]);
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_ASSOC);
    }
}
