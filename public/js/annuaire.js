/**
 * Created by USER on 06/04/2017.
 * code js pour la partie annuaire.
 */


/***
 * Faire la recherche selon un mot donné dans la zone de texte.
 */

$("#btn-find-an").click(function(){
    alert("recherche de l'élément suivant entré");
});


/***
 * Permet de lancer la recherche personnalisée.
 */
$("#btn-find-filter-an").click(function () {
    $("#result_Search").show();
});

/**** Pour les dataTables ***/
$(document).ready(function() {
    $("#table_resultats").DataTable();
} );