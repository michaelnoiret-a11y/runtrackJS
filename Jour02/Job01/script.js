// let article = document.createElement("article");
// article.setAttribute("id", "citation");
// document.getElementById("citation");
// article.textContent = "La vie a beaucoup plus d’imagination que nous";
// document.body.appendChild(article);

// let button = document.createElement("button");
// button.setAttribute("button");

// function citation() {
//     // if (addEventListener == "click") {
//     if (onclick == true) {
//     document.getElementById("citation")
//     console.log("citation")
//     }
// }
// button.addEventListener("click", function citation() {
//     alert("Clic !");
    
// })
// button.addEventListener("click", function() {
// function citation() {
//     if (button.onclick == true) {
//         document.getElementById("citation")
//         console.log("citation");
//     }
// }
// citation();
// })

button.addEventListener("click", function () {
    const element = document.getElementById("citation");
    element.textContent = "Nouvelle citation";
});
