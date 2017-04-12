/**
 * Created by michelB on 11/04/2017.
 */

$('#password_confirmation').keyup(function(event){

    if($('#new_password').val() == $('#password_confirmation').val()){

        $(this).css('border-color', 'green');
    }else {
        $(this).css('border-color', 'red');
    }


});

