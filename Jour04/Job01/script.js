document.getElementById("button").addEventListener("click", function() {
fetch("expression.txt")
if (response.ok) {
.then (response => response.json())
.then (data => console.log(data))
.catch (error => console.log(error))
document.createElement("p").textContent("data");

}
})


// $("button").on("click", function() {
// $.get("expression.txt", function(data) {
// console.log(data)
// })
// });

// $.ajax({
//     url: "expression.txt",
//     method: "GET",
//     success: function(data) { console.log(data); },
//     error: function(err) { console.log(err)} }
// );