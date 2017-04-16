/**
 * Created by USER on 07/04/2017.
 */

/**
 * Js pour la partie demande d'adhésion.
 */
var show_demande = false;

$('#show_demande').click( cacher_afficher_adhesion);
$('#hide_demande').click( cacher_afficher_adhesion);

console.log(group.name);

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


function refuser(user){
    alert("vous voulez refuser l'invitation de "+user);
}

/*
ici c'est la confirmation.
 */
$('.send-btn').click(function () {
    chaine = this.id;
    alert("tu ma cliqué");
    if(chaine.indexOf("btn-accept-",0) != 0){
        //il a triché, il faut arreter la requete.
    }
    var id_user = chaine.substring(11,chaine.length);
    if(isNaN(id_user)){
       //ce n'est pas un nombre, il a encore triché. il faut arreter la requete.
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
            if(data == "success"){
                // tout a marché comme sur des roulettes.
                $("#tr-user-"+id_user+"").hidde();
                $("#message_adhesion").html("<div class=\"alert alert-success fade in\">" +
                    "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                    "<i class=\"icon-remove\"></i></button>" +
                    "<strong>La demande d'adhésion a été validé avec succès.</strong> " +
                    "</div>");
            }
            else{
                $("#message_adhesion").html("<div class=\"alert alert-block alert-danger fade in\">" +
                    "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                    "<i class=\"icon-remove\"></i></button>" +
                    "<strong>Erreur lors de la validation de la demande, success method.</strong> " +
                    "</div>");
            }
        },
        error : function (data) {
            alert("erreur lors de la validation. la valeur est : "+data);
            $("#message_adhesion").html("<div class=\"alert alert-block alert-danger fade in\">" +
                "<button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">" +
                "<i class=\"icon-remove\"></i></button>" +
                "<strong>Erreur lors de la validation de la demande. <br> erreur =</strong> " + data +
                "</div>");

        }
    });
}


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