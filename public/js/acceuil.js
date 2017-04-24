/**
 * Created by hp on 22/04/2017.
 */
$("select.form-control").change(function(){
    $("#amount_contribution").val($(this).val());
});