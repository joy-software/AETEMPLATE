/**
 * Created by USER on 07/04/2017.
 */

/**
 * Js pour la partie demande d'adhésion.
 */
var show_demande = false;

$('#show_demande').click( cacher_afficher_adhesion);
$('#hide_demande').click( cacher_afficher_adhesion);


function cacher_afficher_adhesion() {

    if(show_demande == false){
        $("#section_demande").css("display","block");
        $("#show_demande").addClass("hidden");
        $("#hide_demande").removeClass("hidden");

        show_demande=true;
    }
    else {
        show_demande=false;
        $("#section_demande").css("display","none");
        $("#hide_demande").addClass("hidden");
        $("#show_demande").removeClass("hidden");
    }

}

/*
ici c'est la confirmation.
 */

$('.refuse-btn').click(function(){
   var chaine = this.id;
    if(chaine.indexOf("btn-refuse-",0) != 0){
        alert("les informations sont incorrectes");
    }
    var id_user = chaine.substring(11,chaine.length);
    if(isNaN(id_user)){
        alert("informations incorrectes");
    }
    var id_group = group.id;
    var nom_user = $("#td-name-"+id_user+"").text();
    if(!confirm("Nous allons procéder a la suppression de la demande du membre "+nom_user)){
        return false;
    }

    $.ajax({
        //url: '/group/valid_adhesion_group/id_user='+id_user+'/id_group='+id_group,
        url: '/group/del_adhesion_group',
        type: "post",
        dataType: 'json',
        data: {'id_user':id_user, 'id_group': id_group, '_token': _token},
        //data : "id_user="+id_user+"&id_group="+id_group,
        //data: {'email':$('input[name=email]').val(), '_token': $('input[name=_token]').val()},
        success: function(data){
            var rep = data;
            if(rep.type === "success"){
                alert('le message est : '+rep.message);
                // tout a marché comme sur des roulettes.
                if($('#tab_demande tr').length > 1){
                    $("#tr-user-"+id_user+"").hide();
                  }
                else{
                    $("#section_demande").hide();
                    $("#hide_demande").hide();
                }

                $("#message_adhesion").html("<div class=\"alert alert-success fade in\">" +
                    "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                    "<i class=\"icon-remove\"></i></button>" +
                    "<strong>"+rep.message+"</strong> " +
                    "</div>");
            }
            else{
                if(rep.type === "error"){
                    $("#message_adhesion").html("<div class=\"alert alert-block alert-danger fade in\">" +
                        "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                        "<i class=\"icon-remove\"></i></button>" +
                        "<strong>"+rep.message+"</strong> " +
                        "</div>");
                }
            }

        },
        error : function (data) {
            alert(data);
            alert("erreur lors de la suppression.");
            $("#message_adhesion").html("<div class=\"alert alert-block alert-danger fade in\">" +
                "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                "<i class=\"icon-remove\"></i></button>" +
                "<strong>Erreur lors de la suppression de la demande. <br> erreur =</strong> " + data +
                "</div>");

        }
    });

});

$('.send-btn').click(function () {
    var chaine = this.id;
    //alert("tu ma cliqué");
    if(chaine.indexOf("btn-accept-",0) != 0){
        //il a triché, il faut arreter la requete.
    }
    var id_user = chaine.substring(11,chaine.length);
    if(isNaN(id_user)){
       //ce n'est pas un nombre, il a encore triché. il faut arreter la requete
    }

    var id_group = group.id;
    var description = $("#td-desc-"+id_user+"").text();
    var nom_user = $("#td-name-"+id_user+"").text();
    var photo = $("#td-image-"+id_user+"").html();


    $(".modal-title").html("<i class=\"icon_plus_alt2\"></i>"+group.name + " >> Valider l'adhésion");
    $(".modal-body").html("<h4>nom_user </h4>" + "<br> " +
        "<p style='float: left; width: 150px; height: auto; margin-right: 20px;'>"+photo+" </p>"+
        "<p style='text-align: justify;'>"+ description + "" +
        " </p>" +
        "<p style='text-align: center;'> <br> <button id='btn-valid-adh-"+id_user+"' class='btn btn-primary btn-valid-adhesion' onclick='accepter("+id_user+","+id_group+")' style='margin-right: 50px;'>Accepter l'adhésion du membre </button>" +
        " <button class='btn btn-success' onclick=\"$('#ConfirmAction').modal('toggle');\">Annuler</button> </p>");

    //alert(nom_user + "<br>"+ description + " <br> Etes vous sur de vouloir ajouter ce membre? ");
});

/**
 * ici c'est la suppression finale, il valide l'adhésion du membre.
 */

function accepter(id_user, id_group){
    $('#ConfirmAction').modal('toggle');
    $.ajax({
        //url: '/group/valid_adhesion_group/id_user='+id_user+'/id_group='+id_group,
        url: '/group/valid_adhesion_group',
        type: "post",
        dataType: 'json',
        data: {'id_user':id_user, 'id_group': id_group, '_token': _token},
        //data : "id_user="+id_user+"&id_group="+id_group,
        //data: {'email':$('input[name=email]').val(), '_token': $('input[name=_token]').val()},
        success: function(data){
            var rep = data;
            if(rep.type === "success"){
                alert('le message est : '+rep.message);
                // tout a marché comme sur des roulettes.
                if($('#tab_demande tr').length > 1){
                    $("#tr-user-"+id_user+"").hide();
                }
                else{
                    $("#section_demande").hide();
                    $("#hide_demande").hide();
                }

                $("#message_adhesion").html("<div class=\"alert alert-success fade in\">" +
                    "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                    "<i class=\"icon-remove\"></i></button>" +
                    "<strong>"+rep.message+"</strong> " +
                    "</div>");
            }
            else{
                if(rep.type === "error"){
                    $("#message_adhesion").html("<div class=\"alert alert-block alert-danger fade in\">" +
                        "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                        "<i class=\"icon-remove\"></i></button>" +
                        "<strong>"+rep.message+"</strong> " +
                        "</div>");
                }
            }

        },
        error : function (data) {
            alert(data);
            alert("erreur lors de la validation. la valeur est : "+data);
            $("#message_adhesion").html("<div class=\"alert alert-block alert-danger fade in\">" +
                "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                "<i class=\"icon-remove\"></i></button>" +
                "<strong>Erreur lors de la validation de la demande. <br> erreur =</strong> " + data +
                "</div>");

        }
    });
}


var bool_check_even = false; // il est caché.
$("#p_date_even").hide();
$("#checkbox-even").click(function(){
    if(bool_check_even == false){
        $("#p_date_even").show();
        bool_check_even = true;
    }
    else{
        $("#p_date_even").hide();
        bool_check_even = false;
    }
});

var bool_file1  = false;
var bool_file2 = false;
var bool_file3 = false;

$("#span_file2").hide();
$("#span_file3").hide();

$("#file1").change(function() {

    if($("#file1").val() != ''){ //il y'a quelque chose à l'intérieur.
        $("#file1").removeClass('btn-primary').addClass('btn-success');
        if(bool_file2 == false){
            $("#span_file2").show();
        }
    }
    else{
        $("#file1").removeClass('btn-success').addClass('btn-primary');
        if($("#file2").val() == ""){
            $("#span_file2").hide();
        }
        if($("#file3").val() ==""){
            $("#span_file3").hide();
        }
    }
});

$("#file2").change(function () {
    if($("#file2").val()!=''){
        $("#file2").removeClass('btn-primary').addClass('btn-success');
        $("#span_file3").show();
    }
    else{
        $("#file2").removeClass('btn-success').addClass('btn-primary');
        if($("#file3").val()=='') {
            $("#span_file3").hide();
        }
        if($("#file1").val()=='') {
            $("#span_file2").hide();
        }
    }
});

$("#file3").change(function () {
    if($("#file3").val()==''){
        $("#file3").removeClass('btn-success').addClass('btn-primary');
        if($("#file2").val()=='') {
            $("#span_file3").hide();
        }
    }
    else{
        $("#file3").removeClass('btn-primary').addClass('btn-success');
    }
});

var form_create_ad = null;
$("#create_ad").on('submit', function (event) {
    event.preventDefault();
    console.log("on a cliqué");
    form_create_ad = this;
    var data = new FormData( this );

    console.log("url = "+ form_create_ad['action']);
    console.log("method = "+ form_create_ad['method']);

    $.ajax({
        url: form_create_ad['action'],
        type: form_create_ad['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {
            if(response.responseJSON.success){
                console.log("reponse = "+response['success']);
            }
            else {
                console.log("reponse = "+response['error']);
            }
            //console.log("Reponse = "+response.responseJSON.success);
            //console.log(response);
        },
        error : function () {
            //alert("erreur");
            console.log("Erreur = "+response.responseJSON.error);
        }

    });
});


/*
$("#show_demande").click(function(){

});

/***** filtrage de la database //*/

function filterGlobal () {
    $('#table_resultats').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}

function filterColumn ( i ) {
    $('#table_resultats').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
        $('#col'+i+'_regex').prop('checked'),
        $('#col'+i+'_smart').prop('checked')
    ).draw();
}

$(document).ready(function() {
    $('#table_resultats').DataTable();

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );


$(document).ready(function() {
    $('#table_resultats').DataTable();

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );