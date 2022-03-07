//separateur de milliers javascript
function numStr(a, b) {
    a = '' + a;
    b = b || ' ';
    let c = ''
        , d = 0;
    while (a.match(/^0[0-9]/)) {
        a = a.substr(1);
    }
    for (let i = a.length - 1; i >= 0; i--) {
        c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
        d++;
    }
    return c;
}
$(".afficher").on('click', function(e) {
    let id = $(this).data("id");
    $.ajax({
        method: "GET"
        , url: "/afficher_module"
        , data: {
            Id: id
        }
        , dataType: "html"
        , success: function(response) {

            let userData = JSON.parse(response);
            console.log(userData);
            //parcourir le premier tableau contenant les info sur les programmes
            for (let $i = 0; $i < userData.length; $i++) {
                $("#reference").text(userData[$i].reference);
                $("#nom_module").text(userData[$i].nom_module);
                $("#prix").text(numStr(userData[$i].prix, ' '));
                $("#heure").text(userData[$i].duree);
                $("#heure2").text(userData[$i].duree);
                $("#jour").text(userData[$i].duree_jour);
                $("#jour2").text(userData[$i].duree_jour);
                $("#objectif").text(userData[$i].objectif);
                $("#prerequis").text(userData[$i].prerequis);
                $("#modalite").text(userData[$i].modalite_formation);
                $("#modalite2").text(userData[$i].modalite_formation);
                $("#description").text(userData[$i].description);
                $("#materiel").text(userData[$i].materiel_necessaire);
                $("#bon_a_savoir").text(userData[$i].bon_a_savoir);
                $("#cible").text(userData[$i].cible);
                $("#prestation").text(userData[$i].prestation);
                $("#nom_formation").text(userData[$i].nom_formation);
                $("#niveau").text(userData[$i].niveau);
            }

        }
        , error: function(error) {
            console.log(error)
        }
    });
});
$('#fermer', '.close').on('change', function(e) {
    let ul = document.getElementById('programme');
    ul.innerHTML = '';

});
$(".suppression").on('click', function(e) {
    let id = e.target.id;
    $.ajax({
        type: "GET"
        , url: "/destroy_module'"
        , data: {
            Id: id
        }
        , success: function(response) {
            if (response.success) {
                window.location.reload();
            } else {
                alert("Error")
            }
        }
        , error: function(error) {
            console.log(error)
        }
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    // CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
    $("#reference_search").autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: "/searchReference"
                , type: 'get'
                , dataType: "json"
                , data: {
                    //    _token: CSRF_TOKEN,
                    search: request.term
                }
                , success: function(data) {
                    // alert("eto");
                    response(data);
                }
                , error: function(data) {
                    alert("error");
                    //alert(JSON.stringify(data));
                }
            });
        }
        , select: function(event, ui) {
            // Set selection
            $('#reference_search').val(ui.item.label); // display the selected text
            $('#stagiaireid').val(ui.item.value); // save selected id to input
            return false;
        }
    });
});
    // CSRF Token
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function() {
    $("#categorie_search").autocomplete({
        source: function(request, response) {
            // Fetch data
            $.ajax({
                url: "/searchCategorie"
                , type: 'get'
                , dataType: "json"
                , data: {
                    //    _token: CSRF_TOKEN,
                    recheche: request.term
                }
                , success: function(data) {
                    // alert("eto");
                    response(data);
                }
                , error: function(data) {
                    alert("error");
                    //alert(JSON.stringify(data));
                }
            });
        }
        , select: function(event, ui) {
            // Set selection
            $('#categorie_search').val(ui.item.label); // display the selected text
            $('#stagiaireid').val(ui.item.value); // save selected id to input
            return false;
        }
    });
});

$(document).ready(function(){
    $("#myTab a:last").tab("show"); // show last tab
});

function resetForm() {
    document.getElementById("frm_modif_module").reset();
}

function competence() {
    var html = '';
    html += '<div class="d-flex" id="row_new">';
    html +=     '<div class="col-7">';
    html +=         '<div class="form-group">';
    html +=             '<div class="form-row">';
    html +=                 '<input type="text" name="titre_competence[]" id="titre_competence" class="form-control input" required>';
    html +=                 '<label for="titre_competence" class="form-control-placeholder">Compétences';
    html +=                 '</label>';
    html +=             '</div>';
    html +=         '</div>';
    html +=     '</div>';

    html +=     '<div class="col-4">';
    html +=         '<div class="form-group ms-1">';
    html +=             '<div class="form-row">';
    html +=                 '<input type="number" name="objectif[]" id="objectif" min="1" max="10" class="form-control input" required>';
    html +=                 '<label for="objectif" class="form-control-placeholder">Notes';
    html +=                 '</label>';
    html +=             '</div>';
    html +=         '</div>';
    html +=     '</div>';

    html +=     '<div class="col-1">';
    html +=         '<div class="mt-3">';
    html +=                '<button id="removeRow" class="form-control btn_competence" type="button">';
    html +=                     '<i class="bx bx-minus" style="font-size: 20px">';
    html +=                     '</i>';
    html +=                 '</button>';
    html +=         '</div>';
    html +=     '</div>';
    html += '</div>';

    $('#newRow').append(html);
}

// remove row
$(document).on('click', '#removeRow', function() {
    $(this).closest('#row_new').remove();
});