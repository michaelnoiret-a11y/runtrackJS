<?php

// ==============================
// 1. ENTRY POINT (public/index.php)
// ==============================

require_once '../core/Router.php';
require_once '../core/Database.php';


$router = new Router();
$router->run();


// ==============================
// 6. EXAMPLE ROUTES (API)
// ==============================

$router->get('/api/products', function () {
    $controller = new ProductController();
    $controller->index();
});

$router->get('/api/product', function () {
    $controller = new ProductController();
    $controller->show();
});

// ==============================
// 9. ROUTES AUTH
// ==============================

$router->post('/api/auth/register', function () {
    $controller = new AuthController();
    $controller->register();
});

$router->post('/api/auth/login', function () {
    $controller = new AuthController();
    $controller->login();
});

$router->post('/api/auth/logout', function () {
    $controller = new AuthController();
    $controller->logout();
});

// ==============================
// 12. ROUTES PANIER
// ==============================

$router->get('/api/cart', function () {
    $controller = new PanierController();
    $controller->getCart();
});

$router->post('/api/cart/add', function () {
    $controller = new PanierController();
    $controller->add();
});

$router->post('/api/cart/remove', function () {
    $controller = new PanierController();
    $controller->remove();
});

// ==============================
// 15. ROUTE COMMANDE
// ==============================

$router->post('/api/order/checkout', function () {
    $controller = new CommandeController();
    $controller->checkout();
});

// ==============================
// 18. ROUTES HISTORIQUE
// ==============================

$router->get('/api/orders', function () {
    $controller = new HistoriqueController();
    $controller->getOrders();
});

$router->get('/api/order', function () {
    $controller = new HistoriqueController();
    $controller->getOrder();
});

/*
==============================
HISTORIQUE AJOUTÉ
==============================
- liste commandes utilisateur
- détail commande avec produits
- jointure produit pour affichage front

PROJET MAINTENANT COMPLET CÔTÉ BACK-END :
AUTH + PANIER + COMMANDE + HISTORIQUE
*/

// ==============================
// 22. ROUTES ADMIN
// ==============================

$router->post('/api/admin/product/add', function () {
    $controller = new AdminController();
    $controller->addProduct();
});

$router->post('/api/admin/product/update', function () {
    $controller = new AdminController();
    $controller->updateProduct();
});

$router->post('/api/admin/product/delete', function () {
    $controller = new AdminController();
    $controller->deleteProduct();
});

$router->post('/api/admin/category/add', function () {
    $controller = new AdminController();
    $controller->addCategory();
});

$router->post('/api/admin/category/delete', function () {
    $controller = new AdminController();
    $controller->deleteCategory();
});

/*
==============================
BACK-OFFICE ADMIN AJOUTÉ
==============================
- CRUD produits complet
- CRUD catégories
- protection rôle admin
- sécurisation accès

PROJET BACK-END COMPLET :
AUTH + PANIER + COMMANDE + HISTORIQUE + ADMIN
*/
