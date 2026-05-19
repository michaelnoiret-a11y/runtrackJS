<?php

// ==============================
// 7. MODEL - USER (AUTH)
// ==============================

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($pseudo, $email, $password) {
        $stmt = $this->db->prepare(
            "INSERT INTO users (pseudo, email, mot_de_passe) VALUES (?, ?, ?)"
        );

        $hash = password_hash($password, PASSWORD_BCRYPT);
        return $stmt->execute([$pseudo, $email, $hash]);
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

/*
==============================
SECURITE AJOUTEE
==============================
- password_hash (bcrypt)
- password_verify
- sessions PHP
- API JSON sécurisée

PROCHAINE ETAPE POSSIBLE :
- middleware auth (routes protégées)
- panier utilisateur
- admin role protection
*/