let button = document.createElement("button");
button.setAttribute("id", "button");
document.body.appendChild(button);
button = document.querySelector("button");
button.addEventListener("click", function showhide() {
alert("Clic !")
})

let article = document.createElement("article");
document.getElementById("article")
article.textContent = "L'important n'est pas la chute, mais l'atterrissage.";

button.addEventListener("click", function () {
function showhide() {
    if (citation.style.display === "none") {
        document.getElementById("article").style.display = "block";
    } 
    else {
        document.getElementById("article").style.display = "none";
    }
    }
});
