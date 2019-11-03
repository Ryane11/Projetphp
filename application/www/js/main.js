'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////
//Burger
  
  /* $(".burger").on('click' ,function() {
        $("nav").toggleClass('on');
        $(".navbar-nav").toggleClass('on');
    });
    
    */
    
    //transition nav 
	$(".burger").on('click' ,function() {
	        $(".navbar-nav").fadeToggle( "slow", "linear" );
	});

    
// Suppréssion d'un Article en tant qu'Administrateur

function reload(){
    $(".post").load().fadeIn("slow");
    console.log("page recharger");
};

$(".delete").click(function ajax(){
	var $dataId=$(this).attr('data-article-id');
    $.ajax({
       url : 'user/delete',
       type : 'GET',
       data : 'data-article-id=' + $dataId,
       success :  function(code_html, statut){

       		$(".delete").on('click', function delete_Node()
            {
       			$(this).closest('li').fadeOut();
       			alert ("Vous avez bien supprimé ce message !");
       		});
       },
       
       error : function(resultat, statut, erreur){
       	
        	console.log('Pas ok');
        	alert ("Le message n'a pas été supprimé !");
       }

    });
});
      


//Masquer la Description
$(".content_eyes").on('click',function(e){
$(this).find($('.fa')).toggleClass(' fa-eye fa-eye-slash ');
$(this).siblings($('.content_eyes div')).fadeToggle("slow", "linear");
});

//Footer ScrollTop
   var $header = $('header');
$('.scrollTop').click(function(){

        $('html, body').animate({scrollTop: $header.height()},'slow');
    });



function runFormValidation()
{
    var $form;
    var formValidator;

    $form = $('form:not([data-no-validation=true])');

    // Y a t'il un formulaire Ã  valider sur la page actuelle ?
    if($form.length == 1)
    {
        // Oui, exÃ©cution de la validation de formulaire.
        formValidator = new FormValidator($form);
        formValidator.run();
    }
}

/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

$(function()
{
    // Effet spÃ©cial sur la boite de notifications (le flash bag).
    $('#notice').delay(3000).fadeOut('slow');


    // Exécution de la validation de formulaire si besoin.
    runFormValidation();

});

    /*
$(".delete").on('click',function(del){
    $.ajax({
      type: "POST",
      url: "/DeleteArticle.php",
      data: "param="+parameters,
      
      success: function(stream)
       {
        console.log('success');
       }
    });
};*/