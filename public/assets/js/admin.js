
$(".btn-del").click(function () {

    var chaine = this.id;
    if(chaine.indexOf("group",0) != 0){
        alert("les informations sont incorrectes");
        return false;
    }
    var id_group = chaine.substring(5,chaine.length);
    if(isNaN(id_group)){
        alert("informations incorrectes");
        return false;
    }

    if(!confirm("Vous êtes sur le point de supprimer le groupe "+ $("#td_"+id_group).html())){
        return false;
    }

    $(".btn-del").addClass("disabled");

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: '/admin/del_group',
        type: "post",
        dataType: 'json',
        data: {'id_group': id_group, '_token': _token},
        success: function(data){
            $("#message").html(data.message);
            $(".btn-del").removeClass("disabled");


            if(data.type == 'error'){
                $("#tr_"+id_group).show();
            }
        },
        error : function (erreur) {
            $("#message").html(erreur);
            $(".btn-del").removeClass("disabled");
        }

    });
});




$(".btn-suspen").click(function () {

    var chaine = this.id;

    if(chaine.indexOf("user_suspen_",0) != 0){
        alert("les informations sont incorrectes");
        return false;
    }
    var id_user = chaine.substring(12,chaine.length);
    if(isNaN(id_user)){
        alert("informations incorrectes");
        return false;
    }

    if(!confirm("Vous êtes sur le point de suspendre "+ $("#td_"+id_user).html() + ". Cliquer sur OK pour confirmer la suppression.")){
        return false;
    }

    $(".btn-suspen").addClass("disabled");

    var id_group = $("#id_group").val();

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: '/admin/post_suspen_user',
        type: "post",
        dataType: 'json',
        data: {'id_user': id_user, 'id_group' : id_group, '_token': _token},
        success: function(data){
            $("#message").html(data.message);
            $(".btn-suspen").removeClass("disabled");
            $("#tr_"+id_user).hide();
        },
        error : function (erreur) {
            $("#message").html(erreur);
            $(".btn-suspen").removeClass("disabled");
        }

    });
});





$(".btn-admin").click(function () {

    var chaine = this.id;

    if(chaine.indexOf("user_admin_",0) != 0){
        alert("les informations sont incorrectes");
        return false;
    }
    var id_user = chaine.substring(11,chaine.length);
    if(isNaN(id_user)){
        alert("informations incorrectes");
        return false;
    }

    if(!confirm("Vous êtes d'ajouter "+ $("#td_"+id_user).html() + " comme 'Administrateur' de ce groupe. Cliquer sur OK pour confirmer.")){
        return false;
    }

    $(".btn-admin").addClass("disabled");

    var id_group = $("#id_group").val();

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: '/admin/post_admin_user',
        type: "post",
        dataType: 'json',
        data: {'id_user': id_user, 'id_group' : id_group, '_token': _token},
        success: function(data){
            $("#message").html(data.message);
            $(".btn-admin").removeClass("disabled");
            //$("#tr_"+id_user).hide();
        },
        error : function (erreur) {
            $("#message").html(erreur);
            $(".btn-admin").removeClass("disabled");
        }

    });
});




$(".set_compta").click(function (event) {

    event.preventDefault();

    var chaine = this.id;

    if(chaine.indexOf("set_compta_",0) != 0){
        alert("les informations sont incorrectes");
        return false;
    }
    var id_user = chaine.substring(11,chaine.length);
    if(isNaN(id_user)){
        alert("informations incorrectes");
        return false;
    }

    if(!confirm("Vous êtes sur le point d'ajouter le membre "+ $("#td_"+id_user).html() + " comme 'Comptable' de l'association. Cliquer sur OK pour confirmer.")){
        return false;
    }

    $(".set_compta").addClass("disabled");

    //var id_group = $("#id_group").val();

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: '/admin/post_role_compta',
        type: "post",
        dataType: 'json',
        data: {'id_user': id_user, '_token': _token},
        success: function(data){
            $("#message").html(data.message);
            $(".set_compta").removeClass("disabled");
            //$("#tr_"+id_user).hide();
        },
        error : function (erreur) {
            $("#message").html(erreur);
            $(".set_compta").removeClass("disabled");
        }

    });
});


$(".remove_compta").click(function (event) {

    event.preventDefault();

    var chaine = this.id;

    if(chaine.indexOf("remove_compta_",0) != 0){
        alert("les informations sont incorrectes");
        return false;
    }
    var id_user = chaine.substring(14,chaine.length);
    if(isNaN(id_user)){
        alert("informations incorrectes");
        return false;
    }

    if(!confirm("Vous êtes sur le point de retirer les droits de comptabilités au membre "+ $('#td_'+id_user).html() + ". Cliquer sur OK pour confirmer.")){
        return false;
    }

    $(".remove_compta").addClass("disabled");

    //var id_group = $("#id_group").val();

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: '/admin/post_remove_compta',
        type: "post",
        dataType: 'json',
        data: {'id_user': id_user, '_token': _token},
        success: function(data){
            $("#message").html(data.message);
            $(".remove_compta").removeClass("disabled");
            //$("#tr_"+id_user).hide();
        },
        error : function (erreur) {
            $("#message").html(erreur);
            $(".set_compta").removeClass("disabled");
        }

    });
});



$(".set_admin").click(function (event) {

    event.preventDefault();

    var chaine = this.id;

    if(chaine.indexOf("set_admin_",0) != 0){
        alert("les informations sont incorrectes");
        return false;
    }
    var id_user = chaine.substring(10,chaine.length);
    if(isNaN(id_user)){
        alert("informations incorrectes");
        return false;
    }

    if(!confirm("Vous êtes sur le point d'attribuer le droit de comptabilités au membre "+ $('#td_'+id_user).html() + ". Cliquer sur OK pour confirmer.")){
        return false;
    }

    $(".set_admin").addClass("disabled");

    //var id_group = $("#id_group").val();

    $.ajaxSetup(
        {
            headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
        });

    $.ajax({
        url: '/admin/post_role_admin',
        type: "post",
        dataType: 'json',
        data: {'id_user': id_user, '_token': _token},
        success: function(data){
            $("#message").html(data.message);
            $(".set_admin").removeClass("disabled");
            //$("#tr_"+id_user).hide();
        },
        error : function (erreur) {
            $("#message").html(erreur);
            $(".set_admin").removeClass("disabled");
        }

    });
});
//# sourceMappingURL=admin.js.map
