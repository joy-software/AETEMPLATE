$("#btn_add_period").click(function () {
    $("#create_period").css("display","block");
});

$("#btn_annuler_create_period").click(function () {
   $("#create_period").css("display","none");
});

$("#btn_charger_contribution").click(function () {
    $("#")
});


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

                $("#message_file_contribution").text(response.message);
                $("#message_file_contribution").css("color", "green");
                $("#contribution_file").removeClass('btn-danger').addClass('btn-success');
                $("#contribution_file").val();
            }
            else {

                $("#contribution_file").removeClass('btn-success').addClass('btn-danger');
                $("#message_file_contribution").text(response.message);
                $("#message_file_contribution").css("color", "red");

            }
            //console.log("Reponse = "+response.responseJSON.success);
            //console.log(response);
        },
        error : function (erreur) {
            alert("erreur ="+erreur);
            /*
            $("#message").removeClass('alert-success').addClass('alert-danger');
            $("#message").html("<strong>"+erreur+"</strong>");*/
        }

    });
});

