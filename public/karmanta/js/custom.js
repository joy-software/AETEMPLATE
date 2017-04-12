/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    window.location.href = '/groupe';

});

$('#annuaire').click(function(){

    window.location.href = '/annuaire';


});

$('#bibliotheque').click(function(){
    window.location.href = '/filemanager?type=file';

});

$('#comptabilite').click(function(){
    window.location.href = '#';

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

