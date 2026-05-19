<?php

// ==============================
// 8. CONTROLLER - AUTH
// ==============================

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new User();
    }

    // INSCRIPTION
    public function register() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Données invalides']);
            return;
        }

        $success = $this->model->create(
            $data['pseudo'],
            $data['email'],
            $data['password']
        );

        echo json_encode(['success' => $success]);
    }

    // CONNEXION
    public function login() {
        session_start();

        $data = json_decode(file_get_contents("php://input"), true);

        $user = $this->model->findByEmail($data['email']);

        if (!$user || !password_verify($data['password'], $user['mot_de_passe'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Identifiants invalides']);
            return;
        }

        $_SESSION['user_id'] = $user['id_utilisateur'];
        $_SESSION['role'] = $user['role'];

        echo json_encode([
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user['id_utilisateur'],
                'pseudo' => $user['pseudo'],
                'role' => $user['role']
            ]
        ]);
    }

    // DECONNEXION
    public function logout() {
        session_start();
        session_destroy();

        echo json_encode(['message' => 'Déconnexion réussie']);
    }
}