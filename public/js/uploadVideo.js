
$('#btnCloseAddVideo').click(function(event){

    $('#msg').css('display', 'none');
    $('#addVideoAction').css('display', 'none');
    $('.modal-backdrop').css('display', 'none');
    $('#upload-form input').css('background', 'white').val('');
    $('#upload-form textarea').css('background', 'white').val('');
    $('#progress-div').hide();
    $('#progress-bar').css('width', '0%');
    $('#percent').text('0%');
    $('#label-file').text('Choisissez une vidéo');

});

$('.inputfile').change(function (event) {
   $('#msg').css('display', 'none');
});

var formUploadVideo = null;

$("#upload-form").on('submit', function (event) {

    event.preventDefault();
    formUploadVideo = this;
    var data = new FormData( this );
    $('#btnSubmitAddVideo').prop('disabled', true);
    $('#progress-div').show();

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
        resetForm: true,

        xhr: function() {
            var xhr = new window.XMLHttpRequest();

            xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    console.log(percentComplete);

                    $('#progress-bar').css('width', percentComplete + '%');
                    $('#percent').text(percentComplete + '%');

                    if (percentComplete === 100) {
                        $('#progress-div').hide();
                        $('#loader-icon').show();
                    }

                }
            }, false);

            return xhr;
        },

        success: function (response) {

            console.log(response.message);

            if(response.type === "success" ){

                $('#loader-icon').hide();
                $('#msg').removeClass('text-danger').addClass('text-success');
                $('#msg').html(response.message);
                $('#msg').css('display', 'block').css('color', 'green');
                $('#btnSubmitAddVideo').prop('disabled', false);

            }
            else {

                $('#loader-icon').hide();
                $('#msg').removeClass('text-success').addClass('text-danger');
                $('#msg').html(response.message);
                $('#msg').css('display', 'block');
                $('#btnSubmitAddVideo').prop('disabled', false);

            }

        },
        error : function (erreur) {
            $('#loader-icon').hide();
            $('#msg').removeClass('text-success').addClass('text-danger');
            $('#msg').html(response.message);
            $('#msg').css('display', 'block');
            $('#btnSubmitAddVideo').prop('disabled', false);
        }

    });

});

