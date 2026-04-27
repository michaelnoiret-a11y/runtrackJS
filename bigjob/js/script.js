// const form = document.getElementById("form");

// form.addEventListener("submit", function (e) {
//     e.preventDefault(); // empêche le rechargement

// const emailValue = document.getElementById("email").value;
// const mdpValue = document.getElementById("mdp").value;

// console.log(email);
// console.log(mdp);
// console.log("longueur:", mdpValue.length)

// if (mdp.length <= 8) {
//     let p = document.createElement("p");
//     document.getElementById("error-email");
//     p.textContent = "Mot de passe trop court";
//     p.style.color = "red";

//     document.body.appendChild(p);
// } else {
//     if (p) p.remove();

//     if (email.endsWith("@laplateforme")) {
//         let msg = document.createElement("p2");
//         msg.textContent = "Email doit se terminer par @laplateforme";
//         msg.style.color = "red"
//         document.body.appendChild(msg);
//     }

// localStorage.setItem("email", emailValue);
// localStorage.setItem("mdp", mdpValue);

const savedEmail = localStorage.getItem("email");
const savedMdp = localStorage.getItem("mdp");
console.log(savedEmail);
console.log(savedMdp);

// }
// })

// localStorage.removeItem("email", "mdp"); // or .clear to clear all storage items.

// if (document.getElementById(emailValue).value == "@laplateforme.io" && savedEmail !== null && mdpValue !== null) {
//     alert("Vous êtes connecté");

// }

document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
      
          var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
      
              // Date initiale
              initialDate: '2026-04-01',
      
              // le calendrier en français
              locale: 'fr',
      
              // Mise en page des boutons
              headerToolbar: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'dayGridMonth,timeGridWeek,timeGridDay'
              },
      
              // Tous les événements
              events: [{
                  title: 'Projets JavaScript',
                  start: '2026-04-07',
                  end: '2026-04-25'
              }, {
                  title: 'Salon Alternance Ranguin',
                  start: '2026-04-10T09:30:00',
                  end: '2026-04-10T12:30:00'
              }, {
                  title: 'Événement 3 avec lien',
                  url: 'http://example.org/',
                  start: '2026-06-05T12:00:00'
              }]
          });
      
          calendar.render();
      });

    //   if (events[start] >= now()) {
    //     alert("Date passée, vous ne pouvez plus changer de décision")
    //   };

    // if (savedEmail && savedMdp !== null) {
    //     console.log("Vou êtes connecté");
    // }

    