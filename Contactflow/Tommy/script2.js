document.getElementById("form").addEventListener("submit", function(event) {
    event.preventDefault();

    const prenom = document.getElementById("prenom").value;
    const nom = document.getElementById("nom").value;
    const email = document.getElementById("email").value;
    const tel = document.getElementById("tel").value;

    fetch('traitement2.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ prenom: prenom, nom: nom, email: email, tel: tel })
    })
    // .then(response => response.json())
    // .then(data => {
    //     console.log(data);
    // });
});