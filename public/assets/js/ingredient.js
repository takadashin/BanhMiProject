$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

function delete_ingredient(id) {

    $.get("ingredient/delete/" + id, function (data) {

        if (data == "OK") {
            var target = $("#" + id);

            target.hide('slow', function () {
                target.remove();
            });

        }

    });
}


function show_form(form_id) {

    $("form").hide();

    $('#' + form_id).show("slow");

}
function edit_ingredient(id, name) {

    $("#edit_ingredient_id").val(id);

    $("#edit_ingredient_name").val(name);

    show_form('edit_ingredient');


}


$('#add_ingredient').submit(function (event) {

    /* stop form from submitting normally */
    event.preventDefault();

    var name = $('#name').val();
    
    if (name) {
         
        //ajax post the form
        $.post("ingredient/add/", {name: name}).done(function (data) {
            $('#name').val('');          
            $('#add_ingredient').hide("slow");
            $("#ingredient_list").append(data);            
        });
    }
    else {

        alert("Please give a name to ingredient");
    }
});

$('#edit_ingredient').submit(function (event) {
    /* stop form from submitting normally */
    event.preventDefault();
    
    var ingredient_id = $('#edit_ingredient_id').val();
    var name = $('#edit_ingredient_name').val();

    var current_name = $("#span_" + ingredient_id).text();
    var new_name = current_name.replace(current_name, name);

    if (name) {
        //ajax post the form
        $.post("ingredient/update/" + ingredient_id, {name: name}).done(function (data) {
            $('#edit_ingredient').hide("slow");
            $("#span_" + ingredient_id).text(new_name);
        });
    }
    else {
        alert("Please give a name to ingredient");
    }
});
