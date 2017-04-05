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
    $('#aside').css('display', 'none');
    $('#main-content').css('margin-left','0px');
};

expandAsideEffectClick = function(){
    $('#aside').css('display', 'block');
    $('#main-content').css('margin-left','250px');
};


/*
 * Actions performed after a click on the menu item
 */
$('#accueil').click(function(){
    retractAsideEffectClick();
    colorMenuEffectClick('#accueil');
});

$('#groupes').click(function(){
    expandAsideEffectClick();
    colorMenuEffectClick('#groupes');    
});

$('#annuaire').click(function(){
    retractAsideEffectClick();
    colorMenuEffectClick('#annuaire');
});

$('#bibliotheque').click(function(){
    expandAsideEffectClick();
    colorMenuEffectClick('#bibliotheque');
});

$('#comptabilite').click(function(){
    expandAsideEffectClick();
    colorMenuEffectClick('#comptabilite');
});

$('#administration').click(function(){
    expandAsideEffectClick();
    colorMenuEffectClick('#administration');
});

/**
 * Actions performed after a click on logout link
 */

$('#logout-link').click(function(event){
    event.preventDefault();
    event.returnValue = false;
    $('#logout-form').submit();
});
