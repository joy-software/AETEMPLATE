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
            $("#div_message").html(erreur.message);

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
            $("#div_message").html(erreur.message);

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


var form_create_motif;
$("#create_motif").on('submit', function (event) {
    event.preventDefault();

    form_create_motif = this;
    var data = new FormData( this );

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: form_create_motif['action'],
        type: form_create_motif['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {

            if(response.type === "success" ){
                $("#div_message").html(response.message);
                $("#input_motif").val("");
            }
            else {
                $("#div_message").html(response.message);
            }
        },

        error : function (erreur) {
            $("#div_message").html(erreur.message);
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

var form_contrib_user_email;
$("#contrib_user_email").on('submit', function (event) {
    event.preventDefault();

    form_contrib_user_email = this;
    var data = new FormData( this );

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: form_contrib_user_email['action'],
        type: form_contrib_user_email['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {
                $("#message_contrib_email").html(response.message);
        },

        error : function (erreur) {
            $("#message_contrib_email").html(erreur);
        }

    });
});


$(".btn-contribution").click(function(){


});

/********Script Joy*********/
var form_create_contribution_cash;
$("#create_contribution_cash").on('submit', function (event) {
    event.preventDefault();
    form_create_contribution_cash = this;
    //alert(form_create_contribution_cash['action']);
    var data = new FormData( this );
    $("#btn_create_contribution_cash").prop('disabled',true);
    $('#email_membre').prop('disabled', true);
    $('#amount').prop('disabled', true);
    $('#motif').prop('disabled', true);
    $('#periode').prop('disabled', true);
    $("#div_message1").hide();
    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: form_create_contribution_cash['action'],
        type: form_create_contribution_cash['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {
            $("#momobutton").prop('disabled',false);

            if(response.type === "success" ){
                $("#div_message").html(response.message);
                $('#phone1').removeClass('hidden');
                 $('#button_contrib').hide();
                $('#wecashUp').removeClass('hidden');
                $('#create_contribution_cash').prop('action','/post_contribution_cash/callback');
                if(response.data === "bon")
                {
                    $('#email_membre').prop('disabled', false);
                    $('#amount').prop('disabled', false);
                    $('#motif').prop('disabled', false);
                    $('#periode').prop('disabled', false);
                    $("#div_message1").show();
                    $("#div_message1").html(response.message);
                }
            }
            else {
                $("#div_message").html(response.message);
                if(response.type === "fail" ){
                    $("#div_message1").show();
                    $("#div_message1").html(response.message);
                    $('#amount').prop('disabled', false);
                }
                else {
                    $("#btn_create_contribution_cash").prop('disabled',false);
                    $('#email_membre').prop('disabled', false);
                    $('#amount').prop('disabled', false);
                    $('#motif').prop('disabled', false);
                    $('#periode').prop('disabled', false);
                }


            }

        },
        error : function (erreur) {
            $("#div_message").html(erreur.message);

        }

    });
});

$("#momobutton").on('click', function (event) {
        event.preventDefault();
        console.log('yep big big');
        $('#email_membre').prop('disabled', false);
        $('#amount').prop('disabled', false);
        $('#motif').prop('disabled', false);
        $('#periode').prop('disabled', false);
        //$('#ConfirmAction').modal('show');
         $(".modal-title").html("<i class=\"icon_plus_alt2\" style='text-align: center'></i> MoMo Confirmation");
        $(".modal-body").html("<h4>MoMo Confirmation</h4>" + "<br> " +
            "<span style='text-align: justify;'>"+ "Bien vouloir saisir <span style='color = #802717'>*126#</span> et autoriser la transaction " +
            "<span style='color = #802717'>Mobile Money Online</span> en cours d'un montant de " +$('#amount').val()+
            " </p>" +
            " <button class='btn btn-success' style='text-align: center' onclick=\"$('#ConfirmAction').modal('toggle');\">Compris</button> </p>");
    /*$('#ConfirmAction').on('show', function() {
        // remove previous timeouts if it's opened more than once.
            clearTimeout(myModalTimeout);
        // hide it after a minute
            myModalTimeout = setTimeout(function() {
                $('#ConfirmAction').modal('hide');
            }, 5000);
        });//*/

        $('#ConfirmAction').modal('show');

        $("#momobutton").prop('disable',true);
        $("#create_contribution_cash").submit();

});

var form_post_config_momo;
$("#post_config_momo").on('submit', function (event) {
    event.preventDefault();
    form_post_config_momo = this;
    //alert(form_create_contribution_cash['action']);
    var data = new FormData( this );
    $("#btn_post_config_momo").prop('disabled',true);
    $('#email_membre').prop('disabled', true);
    $('#password').prop('disabled', true);

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: form_post_config_momo['action'],
        type: form_post_config_momo['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {

            if(response.type === "success" ){
                $("#div_message").html(response.message);
                $("#btn_post_config_momo").prop('disabled',false);
                $('#email_membre').prop('disabled', false);
                $('#password').prop('disabled', false);
            }
            else {
                $("#div_message").html(response.message);
            }

        },
        error : function (erreur) {
            $("#div_message").html(erreur.message);

        }

    });
});



/********End Script Joy*********/