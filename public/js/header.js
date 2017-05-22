/**
 * Created by hp on 18/04/2017.
 */

$('#alert_notificatoin_bar.dropdown').on('show.bs.dropdown', function(e){
    $('.dropdown-menu').removeClass('invisible');

    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
});

// ADD SLIDEUP ANIMATION TO DROPDOWN-MENU
$('#alert_notificatoin_bar.dropdown').on('hide.bs.dropdown', function(e){
    markAsRead();
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();

});

function markAsRead()
{
   console.log('we are inside');
   $.ajax({
        url: '/notifications',
        type: "post",
        dataType: 'html',
        data:{'_token':_token},
        success: function(data){

                // tout a marché comme sur des roulettes.
                $("#notif-toggle").html(data);
                //alert(data);
        },
        error : function (data) {
            console.log("Erreur lors de la validation. ");
        }
    })
}

function ReloadNotifications()
{
    //alert('we are inside');
    $.ajax({
        url: '/updatenotifications',
        type: "post",
        dataType: 'html',
        data:{'_token':_token},
        success: function(data){

            // tout a marché comme sur des roulettes.
            $("#alert_notificatoin_bar").html(data);
        },
        error : function (data) {
            console.log("Erreur lors de la validation.");
        }
    })
}

$(document).ready(function(){
    _token = $('input[name=_token]').val();
    $('table tr.clickable-row').click(function(){
        markAsRead();
        window.location = $(this).attr('data-href');
        return false;
    });
});


/*
Ajouté par le yobiyork
 */


$(document).ready( function () {
    // Add return on top button
    $('body').append('<div id="returnOnTop" title="Retour en haut">&nbsp;</div>');

    //$('.btn').addClass('disabled');

    // On button click, let's scroll up to top
    $('#returnOnTop').click( function() {
        $('html,body').animate({scrollTop: 0}, 'slow');
    });
    $('.btn').removeClass('disabled');

});





$(window).scroll(function() {
    // If on top fade the bouton out, else fade it in
    if ( $(window).scrollTop() == 0 )
        $('#returnOnTop').fadeOut();
    else
        $('#returnOnTop').fadeIn();
});


retractAsideEffectClick = function(){
    $('#sidebar').css('display', 'none');
    $('#sidebar').css('left', '-250px');
    $('#main-content').css('margin-left', '0px');
};

expandAsideEffectClick = function(){
    $('#sidebar').css('display', 'block');
    $('#sidebar').css('left', '0px');
    $('#main-content').css('margin-left', '250px');

};

slideLeft = function(selectorElement, pixel){
    $(selectorElement).animate({'margin-right': pixel}, 400, function(){$(selectorElement).css('display', 'none')});
};

slideLeftFixed = function(selectorElement, value){
    $(selectorElement).animate({'margin': value}, 400);
};


/*
 * Actions performed after a click on the menu item
 */

$('#accueil').click(function(){
    window.location.href = '/accueil';

});

$('#groupes').click(function(){
    window.location.href = '/group';

});

$('#annuaire').click(function(){

    window.location.href = '/annuaire';


});

$('#bibliotheque').click(function(){
    window.location.href = '/filemanager?type=file';

});

$('#comptabilite').click(function(){
if(compta == false)
{
    window.location.href = '/contrib_user/'+userId;
}
else
{
    window.location.href = '/comptabilite';
}
});

$('#administration').click(function(){
    window.location.href = '/admin';
});


$('#logo_home').click(function(){
    window.location.href = "https://promotvogt.org";
});

/**
 * Actions performed after a click on logout link
 *
 */

/*
 * Actions performed after a click on the menu item
 */

$('#accueil_tog').click(function(){
    window.location.href = '/accueil';

});

$('#groupes_tog').click(function(){
    window.location.href = '/group';

});

$('#annuaire_tog').click(function(){

    window.location.href = '/annuaire';


});

$('#bibliotheque_tog').click(function(){
    window.location.href = '/filemanager?type=file';

});

$('#comptabilite_tog').click(function(){
    if(compta == false)
    {
        window.location.href = '/contrib_user/'+userId;
    }
    else
    {
        window.location.href = '/comptabilite';
    }
});

$('#administration_tog').click(function(){
    window.location.href = '/admin';
});



$('#logout-link').click(function(event){
    event.preventDefault();
    event.returnValue = false;
    $('#logout-form').submit();
});




$('.toggle-nav').off();


$(".toggle-menus").click(function(e) {
    e.preventDefault();
    $(".navs").toggle();
});


/*********One Signal********/
function PromotOneSignal (playerId) {
    console.log('notificaitions');
    console.log("C'est bon l'ami"+playerId);
    console.log("ok passons");

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: '/oneSignal',
        type: 'post',
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: {'_token':_token, 'userId': playerId},
        success: function (response) {
            console.log('response :' +response)
        },
        error : function (erreur) {
            console.log('erreur :' +erreur)
        }
    });
}

/*********End One Signal********/
