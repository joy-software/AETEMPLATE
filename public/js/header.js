/**
 * Created by hp on 18/04/2017.
 */

$('#alert_notificatoin_bar.dropdown').on('show.bs.dropdown', function(e){
    $('.dropdown-menu').removeClass('invisible');

    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
});

// ADD SLIDEUP ANIMATION TO DROPDOWN-MENU
$('#alert_notificatoin_bar.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    markAsRead();
});

function markAsRead()
{
   // alert('we are inside');
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

    $('.btn').addClass('disabled');

    // On button click, let's scroll up to top
    $('#returnOnTop').click( function() {
        $('html,body').animate({scrollTop: 0}, 'slow');
    });


});

$( window ).on( "load", function () {
    $('.btn').removeClass('disabled');
} );


$(window).scroll(function() {
    // If on top fade the bouton out, else fade it in
    if ( $(window).scrollTop() == 0 )
        $('#returnOnTop').fadeOut();
    else
        $('#returnOnTop').fadeIn();
});

colorMenuEffectClick = function(idMenu){
    $('#accueil > a, #groupes > a, #annuaire > a, #bibliotheque > a, #comptabilite > a, #administration > a').css('color', '#8E8E93');
    $(idMenu + ' > a').css('color', '#007AFF');
};

retractAsideEffectClick = function(){
    $('#sidebar').css('display', 'none');
    $('#sidebar').css('left', '-250px');
    $('#main-content').css('margin-left', '0px');
    //$('#sidebar').animate({'left': "-250px"}, 600, function(){$('#sidebar').css('display', 'none')});
    //$('#main-content').animate({'margin-left': "0px"}, 600, function(){});
};

expandAsideEffectClick = function(){
    $('#sidebar').css('display', 'block');
    $('#sidebar').css('left', '0px');
    $('#main-content').css('margin-left', '250px');
    //$('#sidebar').animate({'left': "0px"}, 600, function(){} );
    //$('#main-content').animate({'margin-left': "250px"}, 600, function(){});
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
    window.location.href = '/comptabilite';

});

$('#administration').click(function(){
    window.location.href = '#';

});

/**
 * Actions performed after a click on logout link
 */



$('#logout-link').click(function(event){
    event.preventDefault();
    event.returnValue = false;
    $('#logout-form').submit();
});

/**
 * Actions performed after a clic on sign up button from login form
 */
