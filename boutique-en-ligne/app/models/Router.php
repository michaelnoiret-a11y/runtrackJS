<?php

// ==============================
// 2. CORE - ROUTER
// ==============================

class Router {
    private $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes[$method] as $path => $callback) {
            if ($path === $uri) {
                return call_user_func($callback);
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}