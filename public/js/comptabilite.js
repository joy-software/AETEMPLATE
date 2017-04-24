$("#btn_add_period").click(function () {
    $("#create_period").css("display","block");
});

$("#btn_annuler_create_period").click(function (event) {
    event.preventDefault();
   $("#create_period").css("display","none");
});

/*$("#btn_charger_contribution").click(function (event) {
    event.preventDefault();
});
*/

var form_create_contribution_file;
$("#create_contribution_file").on('submit', function (event) {
    event.preventDefault();

    form_create_contribution_file = this;
    var data = new FormData( this );

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: form_create_contribution_file['action'],
        type: form_create_contribution_file['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {

            if(response.type === "success" ){

                $("#div_message").html(response.message);
                $("#contribution_file").val();
            }
            else {
                $("#div_message").html(response.message);

            }

        },
        error : function (response) {
            $("#div_message").html(response.message);

        }

    });
});



var form_create_contribution;
$("#create_contribution").on('submit', function (event) {
    event.preventDefault();

    form_create_contribution = this;
    var data = new FormData( this );

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: form_create_contribution['action'],
        type: form_create_contribution['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {

            if(response.type === "success" ){

                $("#div_message").html(response.message);
                $("#email_membre").val("");
                $("#amount").val("");
                $("#contribution_file").val();
            }
            else {
                $("#div_message").html(response.message);

            }

        },
        error : function (erreur) {
            $("#div_message").html(response.message);

        }

    });
});


var form_create_period;
$("#create_period").on('submit', function (event) {
    event.preventDefault();

    form_create_period = this;
    var data = new FormData( this );

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: form_create_period['action'],
        type: form_create_period['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {

            if(response.type === "success" ){
                $("#div_message").html(response.message);
                $("#annee").val("");
            }
            else {
                $("#div_message").html(response.message);
            }
        },

        error : function (erreur) {
            $("#div_message").html(response.message);
        }

    });
});



var form_consult_contributions;

$("#consult_contribution").on('submit', function (event) {
    event.preventDefault();

    form_consult_contributions = this;
    var data = new FormData( this );

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: form_consult_contributions['action'],
        type: form_consult_contributions['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {
            $("#tab_resultat").show();

            if(response.type === "success" ){
                $("#tbody").html(response.message);
            }
            else {
                $("#tbody").html(response.message);
            }
        },

        error : function (erreur) {
            console.log('erreur comptabilite');
            $("#tab_resultat").show();
            $("#tbody").html(erreur.message);
        }

    });
});


$(".btn-contribution").click(function () {
    var chaine = this.id;
    alert("tu as cliqué");
    if(chaine.indexOf("btn-contrib-",0) != 0){
        alert("les informations sont incorrectes");
    }
    var id_user = chaine.substring(12,chaine.length);
    if(isNaN(id_user)){
        alert("informations incorrectes");
    }

    $.ajax({
        url: '/comptabilite/contribution_user/',
        type: 'post',
        /*contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,*/
        dataType : 'json',
        data: {'id_user':id_user, '_token': _token},
        success: function (response) {
            $("#tab_resultat").show();

            if(response.type === "success" ){
                $(".modal-title").html("Contributions de l'utilisateur "+ response.userName);
                $("#tbody_contrib").html(response.message);
            }
            else {
                $(".modal-title").html("Contributions de l'utilisateur "+ response.userName);
                $("#tbody_contrib").html(response.message);
            }
        },

        error : function (erreur) {
            $(".modal-title").html("Contributions de l'utilisateur "+ response.userName);
            $("#tbody_contrib").html(erreur);
        }

    });

});