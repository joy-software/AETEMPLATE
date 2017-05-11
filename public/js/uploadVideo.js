
$('#btnAddVideo').click(function(event){

    $('#addVideoAction').css('display', 'block').css('opacity', '1').css('background', 'rgba(0,0,0,0.7)');
});

$('#btnCloseAddVideo').click(function(event){

    $('#msg').css('display', 'none');
    $('#addVideoAction').css('display', 'none');

});

$('.inputfile').change(function (event) {
   $('#msg').css('display', 'none');
});

var formUploadVideo = null;

$("#upload-form").on('submit', function (event) {
    event.preventDefault();

    formUploadVideo = this;
    var data = new FormData( this );

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: formUploadVideo['action'],
        type: formUploadVideo['method'],
        contentType: false, // obligatoire pour de l'upload
        processData: false, // obligatoire pour de l'upload,
        dataType : 'json',
        data: data,
        success: function (response) {

            console.log(response.message);

            if(response.type === "success" ){

                $('#msg').removeClass('text-danger').addClass('text-success');
                $('#msg').text(response.message);
                $('#msg').css('display', 'block').css('color', 'green');

            }
            else {

                $('#msg').removeClass('text-success').addClass('text-danger');
                $('#msg').text(response.message);
                $('#msg').css('display', 'block');

            }

        },
        error : function (erreur) {
            $('#msg').removeClass('text-success').addClass('text-danger');
            $('#msg').text(response.message);
            $('#msg').css('display', 'block');
        }

    });
});
