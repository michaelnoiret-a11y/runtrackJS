<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="/Index" class="route">Index</a>
        <a href="/Connexion" class="route">Connexion</a>
        <a href="/Inscription" class="route">Inscription</a>
        <a href="/Détails" class="route">Détails</a>
       <input type="text" name="recherche" id="search" placeholder="Rechercher un produit...">
       <div id="container"></div>
    </header>
    <main>
        <section>
            <p>Produits phares</p>
        </section>
        <section>
            <p>Derniers produits mis en ligne</p>
        </section>
    </main>
<form id="form">
    Connexion
    <input type="text" name="email" id="email" required>
    <input type="password" name="mdp" id="mdp" required>
    <input type="submit" name="submit" id="submit">
</form>
</body>
</html> -->

<?php

// ==============================
// MVC PHP - Structure de base
// Projet : Boutique jeux vidéo
// ==============================

/*
==============================
ARCHITECTURE ATTENDUE
==============================

/app
  /controllers
  /models
/core
  Router.php
  Database.php
/public
  index.php

==============================
POINTS IMPORTANTS JURY
==============================
- PDO obligatoire (OK)
- MVC séparation logique (OK)
- API JSON (OK)
- extensible (auth, panier, commandes)
*/

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique Jeux Vidéo</title>
    <style>
        /* ==============================
           MOBILE FIRST DESIGN
        ============================== */

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #0f0f1a;
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #1a1a2e;
        }

        .container {
            padding: 15px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .card {
            background: #1e1e2f;
            padding: 10px;
            border-radius: 10px;
        }

        .card img {
            width: 100%;
            border-radius: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #6c5ce7;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #574b90;
        }

        /* Desktop */
        @media (min-width: 768px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
</head>
<body>

<header>
    <h1>🎮 GameShop</h1>
    <div>
        🛒 <span id="cart-count">0</span>
    </div>
</header>

<div class="container">

    <h2>Produits</h2>
    <div class="grid" id="products"></div>

</div>

<script>
// ==============================
// API BASE
// ==============================
const API = "http://localhost/api";

let cart = [];

// ==============================
// CHARGER PRODUITS
// ==============================
async function loadProducts() {
    const res = await fetch(API + "/products");
    const data = await res.json();

    const container = document.getElementById("products");
    container.innerHTML = "";

    data.forEach(product => {
        const div = document.createElement("div");
        div.classList.add("card");

        div.innerHTML = `
            <img src="${product.image || 'https://via.placeholder.com/300'}" />
            <h3>${product.nom}</h3>
            <p>${product.prix} €</p>
            <button onclick="addToCart(${product.id_produit})">Ajouter</button>
        `;

        container.appendChild(div);
    });
}

// ==============================
// AJOUT PANIER (ASYNC)
// ==============================
async function addToCart(id) {
    await fetch(API + "/cart/add", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id_produit: id,
            quantite: 1
        })
    });

    cart.push(id);
    document.getElementById("cart-count").innerText = cart.length;

    alert("Produit ajouté au panier");
}

// ==============================
// INIT
// ==============================
loadProducts();
</script>

<section class="container" id="product-detail" style="margin-top:20px;"></section>

<script>
// ==============================
// PAGE DÉTAIL PRODUIT
// ==============================

async function loadProductDetail(id) {
    const res = await fetch(API + "/product?id=" + id);
    const product = await res.json();

    const container = document.getElementById("product-detail");

    container.innerHTML = `
        <div style="background:#1e1e2f;padding:20px;border-radius:15px;display:grid;grid-template-columns:1fr;gap:15px;">
            <img src="${product.image || 'https://via.placeholder.com/400'}" style="width:100%;border-radius:15px;" />
            <div>
                <h2 style="margin:0 0 10px 0;">${product.nom}</h2>
                <p style="opacity:0.8;">${product.description || 'Aucune description disponible'}</p>
                <h3 style="color:#6c5ce7;">${product.prix} €</h3>

                <div style="display:flex;gap:10px;margin-top:15px;flex-wrap:wrap;">
                    <button onclick="addToCart(${product.id_produit})">🛒 Ajouter au panier</button>
                    <button onclick="buyNow(${product.id_produit})" style="background:#00b894;">⚡ Acheter maintenant</button>
                </div>
            </div>
        </div>
    `;
}

function buyNow(id) {
    addToCart(id).then(() => {
        window.location.href = "/checkout.html";
    });
}

// ==============================
// CLICK SUR PRODUIT (MODIF SIMPLE)
// ==============================
// À ajouter dans loadProducts()
// div.onclick = () => loadProductDetail(product.id_produit);

</script>

<!-- ==============================
PAGE PANIER ULTRA STYLÉE
============================== -->

<section class="container" style="margin-top:20px;">
    <h2>🛒 Mon Panier</h2>
    <div id="cart-items" class="grid"></div>

    <div style="margin-top:20px;background:#1e1e2f;padding:15px;border-radius:12px;">
        <h3>Total : <span id="cart-total">0</span> €</h3>
        <button onclick="checkout()" style="background:#00b894;">Valider la commande ⚡</button>
    </div>
</section>

<script>
// ==============================
// CHARGER PANIER
// ==============================

async function loadCart() {
    const res = await fetch(API + "/cart");
    const data = await res.json();

    const container = document.getElementById("cart-items");
    container.innerHTML = "";

    let total = 0;

    data.items.forEach(item => {
        total += item.prix * item.quantite;

        const div = document.createElement("div");
        div.classList.add("card");

        div.innerHTML = `
            <h3>${item.nom}</h3>
            <p>${item.prix} € x ${item.quantite}</p>
            <p style="color:#6c5ce7;">Sous-total : ${item.prix * item.quantite} €</p>
            <button onclick="removeItem(${item.id_produit})" style="background:#d63031;">Supprimer</button>
        `;

        container.appendChild(div);
    });

    document.getElementById("cart-total").innerText = total;
}

// ==============================
// SUPPRIMER ITEM
// ==============================

async function removeItem(id) {
    await fetch(API + "/cart/remove", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id_produit: id })
    });

    loadCart();
}

// ==============================
// CHECKOUT
// ==============================

async function checkout() {
    const res = await fetch(API + "/order/checkout", {
        method: "POST"
    });

    const data = await res.json();

    alert("Commande validée ! ID : " + data.order_id);
    loadCart();
}

// INIT
loadCart();
</script>

<!-- ==============================
INTERFACE CONNEXION STYLÉE
============================== -->

<section class="container" style="margin-top:30px;">
    <div style="max-width:400px;margin:auto;background:#1e1e2f;padding:20px;border-radius:15px;">
        <h2>🔐 Connexion</h2>

        <input id="email" type="email" placeholder="Email" style="width:100%;padding:10px;margin:8px 0;border-radius:8px;border:none;" />
        <input id="password" type="password" placeholder="Mot de passe" style="width:100%;padding:10px;margin:8px 0;border-radius:8px;border:none;" />

        <button onclick="login()" style="width:100%;background:#6c5ce7;margin-top:10px;">Se connecter</button>
        <button onclick="register()" style="width:100%;background:#00b894;margin-top:10px;">Créer un compte</button>

        <p id="auth-msg" style="margin-top:10px;color:#aaa;"></p>
    </div>
</section>

<script>
// ==============================
// AUTH FRONT (ASYNC)
// ==============================

async function login() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    const res = await fetch(API + "/auth/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, password })
    });

    const data = await res.json();

    document.getElementById("auth-msg").innerText = data.message || data.error;
}

async function register() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const pseudo = email.split("@")[0];

    const res = await fetch(API + "/auth/register", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ pseudo, email, password })
    });

    const data = await res.json();

    document.getElementById("auth-msg").innerText = data.success ? "Compte créé !" : "Erreur inscription";
}
</script>

<!-- ==============================
GAMIFICATION UI (XP + BADGES)
============================== -->

<section class="container" style="margin-top:30px;">
    <div style="background:#1e1e2f;padding:20px;border-radius:15px;">
        <h2>🎮 Profil Joueur</h2>

        <p>XP : <span id="xp">0</span></p>
        <p>Niveau : <span id="level">1</span></p>

        <div style="background:#0f0f1a;height:10px;border-radius:10px;margin:10px 0;">
            <div id="xp-bar" style="height:10px;width:0%;background:#6c5ce7;border-radius:10px;"></div>
        </div>

        <h3>🏆 Badges</h3>
        <div id="badges" style="display:flex;gap:10px;flex-wrap:wrap;"></div>
    </div>
</section>

<script>
// ==============================
// GAMIFICATION SYSTEM
// ==============================

let userXP = 0;
let userLevel = 1;
let badges = [];

function calculateLevel(xp) {
    return Math.floor(xp / 100) + 1;
}

function updateXP(amount) {
    userXP += amount;
    userLevel = calculateLevel(userXP);

    document.getElementById("xp").innerText = userXP;
    document.getElementById("level").innerText = userLevel;

    let progress = userXP % 100;
    document.getElementById("xp-bar").style.width = progress + "%";

    checkBadges();
}

function checkBadges() {
    const newBadges = [];

    if (userXP >= 50) newBadges.push("🔥 Rookie");
    if (userXP >= 200) newBadges.push("🎮 Gamer");
    if (userXP >= 500) newBadges.push("🏆 Pro Player");

    badges = newBadges;
    renderBadges();
}

function renderBadges() {
    const container = document.getElementById("badges");
    container.innerHTML = "";

    badges.forEach(b => {
        const div = document.createElement("div");
        div.style.padding = "8px 12px";
        div.style.background = "#6c5ce7";
        div.style.borderRadius = "20px";
        div.innerText = b;
        container.appendChild(div);
    });
}

// ==============================
// INTEGRATION EXEMPLE
// ==============================

// Ajout XP quand action e-commerce
function onPurchase() {
    updateXP(50);
}

function onAddToCart() {
    updateXP(10);
}

// Hook existant panier
const oldAddToCart = addToCart;
addToCart = function(id) {
    onAddToCart();
    return oldAddToCart(id);
}

// Hook checkout
const oldCheckout = checkout;
checkout = function() {
    updateXP(100);
    return oldCheckout();
}
</script>

<!-- ==============================
SYSTÈME MISSIONS RPG
============================== -->

<section class="container" style="margin-top:30px;">
    <div style="background:#1e1e2f;padding:20px;border-radius:15px;">
        <h2>📜 Missions RPG</h2>

        <div id="quests"></div>
    </div>
</section>

<script>
// ==============================
// SYSTEME DE QUÊTES
// ==============================

let quests = [
    {
        id: 1,
        title: "🛒 Premier achat",
        description: "Effectuer une commande",
        progress: 0,
        target: 1,
        reward: 100,
        completed: false
    },
    {
        id: 2,
        title: "🎮 Collectionneur",
        description: "Ajouter 5 produits au panier",
        progress: 0,
        target: 5,
        reward: 50,
        completed: false
    },
    {
        id: 3,
        title: "🔥 Acheteur actif",
        description: "Ajouter 10 produits au panier",
        progress: 0,
        target: 10,
        reward: 150,
        completed: false
    }
];

function renderQuests() {
    const container = document.getElementById("quests");
    container.innerHTML = "";

    quests.forEach(q => {
        const div = document.createElement("div");
        div.style.background = "#0f0f1a";
        div.style.padding = "10px";
        div.style.marginTop = "10px";
        div.style.borderRadius = "10px";

        let progressPercent = (q.progress / q.target) * 100;

        div.innerHTML = `
            <h3>${q.title}</h3>
            <p>${q.description}</p>
            <p>Progression : ${q.progress}/${q.target}</p>

            <div style="background:#222;height:8px;border-radius:10px;">
                <div style="width:${progressPercent}%;height:8px;background:#6c5ce7;border-radius:10px;"></div>
            </div>

            <p>🎁 Récompense : ${q.reward} XP</p>
            <p>${q.completed ? "✅ Terminée" : "⏳ En cours"}</p>
        `;

        container.appendChild(div);
    });
}

function updateQuestProgress(action) {
    quests.forEach(q => {
        if (q.completed) return;

        if (action === "addToCart" && q.id === 2) {
            q.progress++;
        }

        if (action === "addToCart" && q.id === 3) {
            q.progress++;
        }

        if (action === "checkout" && q.id === 1) {
            q.progress = 1;
        }

        if (q.progress >= q.target && !q.completed) {
            q.completed = true;
            updateXP(q.reward);
        }
    });

    renderQuests();
}

// ==============================
// HOOKS SYSTEME EXISTANT
// ==============================

const oldAddToCart2 = addToCart;
addToCart = function(id) {
    updateQuestProgress("addToCart");
    return oldAddToCart2(id);
}

const oldCheckout2 = checkout;
checkout = function() {
    updateQuestProgress("checkout");
    return oldCheckout2();
}

// INIT
renderQuests();
</script>

<!-- ==============================
UX ANIMATIONS (LEVEL UP / TOAST / BADGES)
============================== -->

<style>
/* TOAST NOTIFICATIONS */
.toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #6c5ce7;
    color: white;
    padding: 12px 16px;
    border-radius: 10px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
    z-index: 9999;
}

.toast.show {
    opacity: 1;
    transform: translateY(0);
}

/* LEVEL UP POPUP */
.levelup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    background: #1e1e2f;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    z-index: 9999;
    transition: all 0.4s ease;
    border: 2px solid #6c5ce7;
}

.levelup.show {
    transform: translate(-50%, -50%) scale(1);
}

/* BADGE ANIMATION */
@keyframes pop {
    0% { transform: scale(0.5); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}

.badge-anim {
    animation: pop 0.4s ease;
}
</style>

<div id="toast" class="toast"></div>

<div id="levelup" class="levelup">
    <h2>🎉 LEVEL UP !</h2>
    <p id="levelup-text"></p>
</div>

<script>
// ==============================
// UX ANIMATION SYSTEM
// ==============================

function showToast(message) {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 2000);
}

let lastLevel = userLevel;

function checkLevelUp() {
    if (userLevel > lastLevel) {
        triggerLevelUp(userLevel);
        lastLevel = userLevel;
    }
}

function triggerLevelUp(level) {
    const popup = document.getElementById("levelup");
    document.getElementById("levelup-text").innerText = "Tu es maintenant niveau " + level + " 🚀";

    popup.classList.add("show");

    setTimeout(() => {
        popup.classList.remove("show");
    }, 2500);
}

// ==============================
// OVERRIDE XP SYSTEM (ANIMATED)
// ==============================

const oldUpdateXP = updateXP;
updateXP = function(amount) {
    oldUpdateXP(amount);
    showToast("+" + amount + " XP");
    checkLevelUp();
};

// ==============================
// BADGE ANIMATION HOOK
// ==============================

const oldRenderBadges = renderBadges;
renderBadges = function() {
    oldRenderBadges();

    const container = document.getElementById("badges");
    container.querySelectorAll("div").forEach(el => {
        el.classList.add("badge-anim");
    });

    showToast("🏆 Nouveau badge débloqué !");
};

</script>

<!-- ==============================
CONFETTI ANIMATION
============================== -->

<canvas id="confetti-canvas" style="position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:9998;"></canvas>

<script>
// ==============================
// SIMPLE CONFETTI SYSTEM
// ==============================

const confettiCanvas = document.getElementById("confetti-canvas");
const ctx = confettiCanvas.getContext("2d");

confettiCanvas.width = window.innerWidth;
confettiCanvas.height = window.innerHeight;

let confettiPieces = [];

function createConfetti() {
    for (let i = 0; i < 120; i++) {
        confettiPieces.push({
            x: Math.random() * confettiCanvas.width,
            y: Math.random() * confettiCanvas.height - confettiCanvas.height,
            r: Math.random() * 6 + 2,
            d: Math.random() * 10 + 5,
            color: `hsl(${Math.random() * 360}, 70%, 60%)`,
            tilt: Math.random() * 10 - 10
        });
    }
}

function drawConfetti() {
    ctx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);

    confettiPieces.forEach(p => {
        ctx.beginPath();
        ctx.fillStyle = p.color;
        ctx.fillRect(p.x, p.y, p.r, p.r);
        ctx.fill();
    });

    updateConfetti();
}

function updateConfetti() {
    confettiPieces.forEach(p => {
        p.y += Math.cos(p.d) + 2;
        p.x += Math.sin(p.d);

        if (p.y > confettiCanvas.height) {
            p.y = -10;
            p.x = Math.random() * confettiCanvas.width;
        }
    });
}

function animateConfetti() {
    drawConfetti();
    requestAnimationFrame(animateConfetti);
}

function launchConfetti() {
    createConfetti();
    setTimeout(() => {
        confettiPieces = [];
    }, 4000);
}

// ==============================
// TRIGGERS (LEVEL UP / CHECKOUT)
// ==============================

const oldTriggerLevelUp = triggerLevelUp;
triggerLevelUp = function(level) {
    launchConfetti();
    oldTriggerLevelUp(level);
};

const oldCheckout3 = checkout;
checkout = function() {
    launchConfetti();
    return oldCheckout3();
};

animateConfetti();
</script>

<!-- ==============================
SOUND EFFECTS UX (WEB AUDIO)
============================== -->

<script>
// ==============================
// SIMPLE SOUND ENGINE (NO FILES)
// ==============================

let audioCtx = null;

function initAudio() {
    if (!audioCtx) {
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }
}

function playBeep(freq = 440, duration = 150, type = "sine") {
    initAudio();

    const osc = audioCtx.createOscillator();
    const gain = audioCtx.createGain();

    osc.type = type;
    osc.frequency.value = freq;

    gain.gain.value = 0.1;

    osc.connect(gain);
    gain.connect(audioCtx.destination);

    osc.start();

    setTimeout(() => {
        osc.stop();
    }, duration);
}

// ==============================
// SOUND EFFECTS
// ==============================

function soundXP() {
    playBeep(600, 120);
    setTimeout(() => playBeep(800, 120), 80);
}

function soundLevelUp() {
    playBeep(523, 150);
    setTimeout(() => playBeep(659, 150), 150);
    setTimeout(() => playBeep(784, 200), 300);
}

function soundPurchase() {
    playBeep(300, 200, "square");
    setTimeout(() => playBeep(500, 200, "square"), 150);
}

// ==============================
// HOOKS INTEGRATION
// ==============================

const oldUpdateXP2 = updateXP;
updateXP = function(amount) {
    soundXP();
    return oldUpdateXP2(amount);
};

const oldTriggerLevelUp2 = triggerLevelUp;
triggerLevelUp = function(level) {
    soundLevelUp();
    return oldTriggerLevelUp2(level);
};

const oldCheckout4 = checkout;
checkout = function() {
    soundPurchase();
    return oldCheckout4();
};

</script>

<!-- ==============================
FINAL POLISH UI (GLOBAL DESIGN SYSTEM)
============================== -->

<style>
:root{
    --bg:#0f0f1a;
    --card:#1e1e2f;
    --card2:#1a1a2e;
    --primary:#6c5ce7;
    --success:#00b894;
    --danger:#d63031;
    --text:#ffffff;
    --muted:#a0a0b0;
}

body{
    background:var(--bg);
    color:var(--text);
}

.container{
    max-width:1100px;
    margin:auto;
}

h1,h2,h3{
    letter-spacing:0.5px;
}

.card{
    background:var(--card);
    border-radius:14px;
    padding:15px;
    transition:0.3s ease;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 30px rgba(0,0,0,0.35);
}

button{
    border:none;
    border-radius:10px;
    padding:10px;
    font-weight:bold;
    transition:0.2s ease;
}

button:hover{
    transform:scale(1.03);
    opacity:0.9;
}

button:nth-of-type(1){ background:var(--primary); color:white; }
button:nth-of-type(2){ background:var(--success); color:white; }

input{
    background:var(--card2);
    color:white;
    outline:none;
}

.grid{
    display:grid;
    grid-template-columns:1fr;
    gap:15px;
}

@media(min-width:768px){
    .grid{ grid-template-columns:repeat(3,1fr); }
}

/* smooth UI feel */
*{
    scroll-behavior:smooth;
}

</style>

<!-- ==============================
SCSS DESIGN SYSTEM (DEVELOPMENT ONLY)
============================== */

/* SCSS (à compiler avec Sass) */

$bg: #0f0f1a;
$card: #1e1e2f;
$primary: #6c5ce7;
$success: #00b894;
$danger: #d63031;
$text: #ffffff;
$radius: 14px;

@mixin flex-center {
  display: flex;
  justify-content: center;
  align-items: center;
}

@mixin card {
  background: $card;
  border-radius: $radius;
  padding: 15px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
  transition: 0.3s ease;

  &:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.35);
  }
}

body {
  background: $bg;
  color: $text;
  font-family: Arial, sans-serif;
}

.container {
  max-width: 1100px;
  margin: auto;
  padding: 15px;
}

.grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 15px;

  @media (min-width: 768px) {
    grid-template-columns: repeat(3, 1fr);
  }
}

.card {
  @include card;
}

button {
  border: none;
  border-radius: 10px;
  padding: 10px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.2s ease;

  &:hover {
    transform: scale(1.03);
  }
}

.btn-primary {
  background: $primary;
  color: white;
}

.btn-success {
  background: $success;
  color: white;
}

.btn-danger {
  background: $danger;
  color: white;
}

input {
  background: $card;
  color: $text;
  border: none;
  padding: 10px;
  border-radius: 10px;
}

/* Smooth UX */
* {
  scroll-behavior: smooth;
}

*/

</body>
</html>
