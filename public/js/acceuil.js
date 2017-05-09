/**
 * Created by hp on 22/04/2017.
 */
$("select.form-control").change(function(){
    $("#amount_contribution").val($(this).val());
});

$('.send-btn').click(function () {

    $(".modal-title").html("<i class=\"icon_plus_alt2\"></i>"+group.name + " >> Valider l'adhésion");
    $(".modal-body").html("<h4>"+nom_user +"</h4>" + "<br> " +
        "<p style='float: left; width: 150px; height: auto; margin-right: 20px;'>"+photo+" </p>"+
        "<p style='text-align: justify;'>"+ description + "" +
        " </p>" +
        "<p style='text-align: center;'> <br> <button id='btn-valid-adh-"+id_user+"' class='btn btn-primary btn-valid-adhesion' onclick='accepter("+id_user+","+id_group+")' style='margin-right: 50px;'>Accepter l'adhésion du membre </button>" +
        " <button class='btn btn-success' onclick=\"$('#ConfirmAction').modal('toggle');\">Annuler</button> </p>");

    //alert(nom_user + "<br>"+ description + " <br> Etes vous sur de vouloir ajouter ce membre? ");
});