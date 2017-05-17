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
    var data = new FormData( this );

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

            if(response.type === "success" ){

                $("#div_message").html(response.message);
                $('#email_membre').prop('disabled', true);
                $('#amount').prop('disabled', true);
                $('#motif').prop('disabled', true);
                $('#periode').prop('disabled', true);
                $('#button_contrib').hide();
                $('#wecashUp').html(response.body);
                $('#create_contribution_cash').prop('action','http://promot-vogt.org/comptabilite/post_contribution_cash/callback');
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

$("#momobutton").on('click', function (event) {
        event.preventDefault();
        console.log('yep big big');
        alert('ok partenaire');
        var form_create_contribution_cash;
        form_create_contribution_cash = $("#create_contribution_cash");
        var data = new FormData( this );

        $.ajaxSetup(
            {
                headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
            });
        console.log('yep big ');
        $.ajax({
            url: '/comptabilite/post_contribution_cash/callback',
            type: form_create_contribution_cash['method'],
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload,
            dataType : 'json',
            data: data,
            success: function (response) {
                /*
                if(response.type === "success" ){

                    $("#div_message").html(response.message);
                    $('#email_membre').prop('disabled', true);
                    $('#amount').prop('disabled', true);
                    $('#motif').prop('disabled', true);
                    $('#periode').prop('disabled', true);
                    $('#button_contrib').hide();
                    $('#wecashUp').html(response.body);
                    $('#create_contribution_cash').prop('action','http://promot-vogt.org/comptabilite/post_contribution_cash/callback');
                }
                else {
                    $("#div_message").html(response.message);

                }/*/
                alert (response);

            },
            error : function (erreur) {
                $("#div_message").html(erreur);
                //$("#div_message").html(erreur.message);

            }

        });
});


/********End Script Joy*********/
//# sourceMappingURL=comptabilite.js.map
