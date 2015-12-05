$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

function updateRecipe(id) {
    document.getElementById("recipeForm").submit();
}

function updateIngredient(id) {
    
    ingredientId = $("[name=ingredientId" + id + "]").val();
    detail = $('[name=detail' + id + ']').val();
    $.post("postRecipe/updateingredient/" + id, {ingredientId:ingredientId,detail:detail}).done(function (recipeId) {
        window.location.href = 'postRecipe?id=' + recipeId;
    }).fail(function() {
           alert( "error" );
    });
}

function updateStep(id) {
    document.getElementById("stepForm").submit();
}


function changeImage(input,id){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#stepImage' + id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
     }
}