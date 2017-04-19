/**
 * Created by hp on 18/04/2017.
 */

$('#alert_notificatoin_bar.dropdown').on('show.bs.dropdown', function(e){
    $('.dropdown-menu').removeClass('invisible');
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
    _token = $('input[name=_token]').val();
});

// ADD SLIDEUP ANIMATION TO DROPDOWN-MENU
$('#alert_notificatoin_bar.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    markAsRead();
});

function markAsRead()
{
    alert('we are inside');
   $.ajax({
        url: '/notifications',
        type: "post",
        dataType: 'html',
        data:{'_token':_token},
        success: function(data){

                // tout a marché comme sur des roulettes.
                $("#alert_notificatoin_bar").html(data);
        },
        error : function (data) {
            alert("erreur lors de la validation. la valeur est : "+data);
        }
    })
}