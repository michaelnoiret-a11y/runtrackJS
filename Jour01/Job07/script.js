function jourtravaille(date) {
    const jourFérié = ["01/01/24", "06/04/24", "01/05/24", "14/07/24", "15/08/24", "11/11/24", "25/12/24"];
    if (date in jourFérié) {
        console.log("Le jour mois année est un jour férié")
    elseif (date == "samedi" || date == "dimanche") {
        console.log( "Non, jour mois année est un week-end");
    } else {
        console.log("Oui, jour mois année est un jour travaillé");
    }    
    }
    jourtravaille(01/01/24);
    }
