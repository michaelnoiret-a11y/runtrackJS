const form = document.getElementById("form");

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const mdp = document.getElementById("mdp").value;

    const errorEmail = document.getElementById("error-email");
    const errorMdp = document.getElementById("error-mdp");

    // reset erreurs
    errorEmail.textContent = "";
    errorEmail.style.color = "red";
    errorMdp.textContent = "";
    errorMdp.style.color = "red";
    let isValid = true;

    // validation mdp
    if (mdp.length <= 8) {
        errorMdp.textContent = "Mot de passe trop court";
        isValid = false;
    }

    // validation email
    if (!email.endsWith("@laplateforme.io")) {
        errorEmail.textContent = "Email invalide (@laplateforme.io requis)";
        isValid = false;
    }

    // si OK
    if (isValid) {
        localStorage.setItem("email", email);
        localStorage.setItem("mdp", mdp);

        console.log("Connexion réussie !");
    }
});

const savedEmail = localStorage.getItem("email");
const savedMdp = localStorage.getItem("mdp");
console.log(savedEmail);
console.log(savedMdp);