// $("input").focus("click", function() {
//     $("champ").focus();
// });

// $("champ").on("click", function() {
//     $("champ").trigger("blur");
// });

$(document).ready(function(){
    //Aggrandi la taille du formulaire
    $("input").focus(function(){
        $(this).css("padding", "20px")

    });

    //Reset la taille du formulaire
    $("form").focusin(function(){
        $("label").css("background-color", "yellow");
        
    });
    $('input').blur(function() {
    $("input").css('padding', '');
    $("input").css('background-color', "")
    
    
});
});