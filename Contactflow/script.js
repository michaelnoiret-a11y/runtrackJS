const form = document.getElementById("form");
const message = document.getElementById("message");
// const repertoire = ["aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ"]

form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const prenom = document.getElementById("prenom").value;
    const nom = document.getElementById("nom").value;
    const telephone = document.getElementById("telephone").value;
    const email = document.getElementById("email").value;
    const adresse = document.getElementById("adresse"). value;



// document.getElementsByClassName("contact");
// contact.addEventListener("click", async function (e) {
//     e.preventDefault();
// });

// document.querySelector("search");
// search.addEventListener("input", async function (e) {
//     e.preventDefault();
// });

// UPDATE : Modifier une ressource
    async function updatePost(id, data) {
      try {
        const response = await fetch(`traitement.php}/${id}`, {
          method: 'PATCH', // ou PUT pour mise à jour complète
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });
        if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);
        const result = await response.json();
        console.log('Mis à jour :', result);
      } catch (error) {
        console.error('Erreur UPDATE :', error.message);
      }
    }

    // DELETE : Supprimer une ressource
    async function deletePost(id) {
      try {
        const response = await fetch(`${traitement.php}/${id}`, { method: 'DELETE' });
        if (!response.ok) throw new Error(`Erreur HTTP: ${response.status}`);
        console.log(`Post ${id} supprimé avec succès`);
      } catch (error) {
        console.error('Erreur DELETE :', error.message);
      }
    }

    // Exemple d'utilisation
    (async () => {
      await updatePost(1, { title: 'Titre modifié', body: 'Contenu modifié', userId: 1 });
      await deletePost(1);
    })();


    try {
        const response = await fetch("traitement.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                prenom : prenom,
                nom : nom,
                telephone : telephone,
                email : email,
                adresse : adresse
            })
        });

        const data = await response.json();
        message.textContent = data.message;
        loadUsers();

    } catch (error) {
        console.error(error);
        message.textContent = "Erreur serveur";
    }
});





document.addEventListener("DOMContentLoaded", () => {
    loadUsers();
});

async function loadUsers() {
    try {
        const res = await fetch("getUsers.php");
        const users = await res.json();

        const container = document.getElementById("container");
        container.innerHTML = "";

        users.forEach(user => {
            const p = document.createElement("p");

            p.innerHTML = `
                <strong>${user.prenom} ${user.nom}</strong><br>
                ${user.email}<br>
                ${user.telephone}<br>
                ${user.adresse}
            `;
            
            container.appendChild(p);
        });

    } catch (error) {
        console.error(error);
    }
}

loadUsers();

// Recherche
let allUsers = []; // 🔥 stock global

async function loadUsers() {
    const res = await fetch("getUsers.php");
    const users = await res.json();

    allUsers = users; // sauvegarde
    displayUsers(users);
}

function displayUsers(users) {
    const container = document.getElementById("container");
    container.innerHTML = "";

    users.forEach(user => {
        const p = document.createElement("p");

        p.innerHTML = `
            <strong>${user.prenom} ${user.nom}</strong><br>
            ${user.email}<br>
            ${user.telephone}<br>
            ${user.adresse}
        `;

        container.appendChild(p);
        
    });
}

const searchInput = document.getElementById("search");

searchInput.addEventListener("input", function () {
    const value = this.value.toLowerCase();

    const filtered = allUsers.filter(user =>
        user.prenom.toLowerCase().includes(value) ||
        user.nom.toLowerCase().includes(value) ||
        user.email.toLowerCase().includes(value) ||
        String(user.telephone).includes(value) ||
        user.adresse.toLowerCase().includes(value)
    );

    displayUsers(filtered);
    console.log(filtered);
});

loadUsers();

// Recherche avec auto complétion
// const search = document.getElementById("search");
// const suggestions = document.getElementById("suggestions");

// search.addEventListener("input", async function () {
//     const value = this.value.trim();

//     if (value.length < 2) {
//         suggestions.innerHTML = "";
//         return;
//     }

//     const res = await fetch(`searchUsers.php?q=${encodeURIComponent(value)}`);
//     const users = await res.json();

//     suggestions.innerHTML = "";

//     users.forEach(user => {
//         const li = document.createElement("li");

//         li.textContent = `${user.prenom} ${user.nom}`;

//         // 🔥 clic sur suggestion
//         li.addEventListener("click", () => {
//             search.value = li.textContent;
//             suggestions.innerHTML = "";
//         });

//         suggestions.appendChild(li);
//     });
// });

// let timeout;

// search.addEventListener("input", function () {
//     clearTimeout(timeout);

//     timeout = setTimeout(() => {
//         fetchSuggestions(this.value);
//     }, 300);
// });

// document.getElementById("recherche");
// recherche.addEventListener("submit", function(e) {
//     e.preventDefault;
// });

// document.getElementsByClassName("modifier");
// modifier.addEventListener("click", function(e) {
//     e.preventDefault;
// });

// document.getElementsByClassName("supprimer");
// supprimer.addEventListener("click", function(e) {
//     e.preventDefault;
// });

// let limit = 5;
// let offset = 0;

// async function loadUsers() {
//     const res = await fetch(`getUsers.php?limit=${limit}&offset=${offset}`);
//     const result = await res.json();

//     const users = result.data;
//     const total = result.total;

//     displayUsers(users);
//     updatePagination(total);
// }

// function displayUsers(users) {
//     const container = document.getElementById("container");
//     container.innerHTML = "";

//     users.forEach(user => {
//         const p = document.createElement("p");
//         p.textContent = `${user.prenom} ${user.nom} - ${user.email}`;
//         container.appendChild(p);
//     });
// }

// document.getElementById("prev").addEventListener("click", () => {
//     if (offset >= limit) {
//         offset -= limit;
//         loadUsers();
//     }
// });

// document.getElementById("next").addEventListener("click", () => {
//     offset += limit;
//     loadUsers();
// });

// function updatePagination(total) {
//     const page = Math.floor(offset / limit) + 1;
//     const totalPages = Math.ceil(total / limit);

//     document.getElementById("pageInfo").textContent =
//         `Page ${page} / ${totalPages}`;
// }

// if (offset + limit >= total) return;

// loadUsers();