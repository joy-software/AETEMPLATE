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

/**** Pour les dataTables
$(document).ready(function() {
    $("#table_resultats").DataTable();
} );
 ***/


/***** filtrage de la database //*/

function filterGlobal () {
    $('#table_resultats').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}

function filterColumn ( i ) {
    $('#table_resultats').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
        $('#col'+i+'_regex').prop('checked'),
        $('#col'+i+'_smart').prop('checked')
    ).draw();
}

$(document).ready(function() {
    $('#table_resultats').DataTable();

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );


$(document).ready(function() {
    $('#table_resultats').DataTable();

    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );

    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
} );
//# sourceMappingURL=annuaire.js.map
