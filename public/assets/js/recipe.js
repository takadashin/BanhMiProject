$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

function Recipe(){
    name;
    description;
    servings;
    image;
}

function getRecipefield(recipe){
    recipe.name = $('#name').val();
    recipe.description = $('#description').val();
    recipe.servings = $('#servings').val();
    recipe.image = $('#image').val();
}

function setRecipefield(recipe){
    $('#name').val(recipe.name);
    $('#description').val(recipe.description);
    $('#servings').val(recipe.servings);
     $('#image').val(recipe.image);
}

function addRecipe() {
    recipe = new Recipe;
    getRecipefield(recipe);
    $.post("postRecipe/add/", {name: recipe.name,description: recipe.description, servings:recipe.servings, image:recipe.image}).done(function (data) {
        setRecipefield(recipe); 
        $('#recipeDetail').show();
    }).fail(function() {
                alert( "error" );
    });;
}

