@extends('layouts.main')

@section('title')
    Home Page
@stop

@section('content')
<div class="innerwrap">
    <div class="header_title">
        <h1>CREATE RECIPE</h1>
    </div>
    <div id="recipeContianer">     
        <form id="recipe">
         <div id="button">
             @if($recipe == null)
             
                <input type="image" src="{{ asset('assets/images/plus.png') }}" onclick="addRecipe()" name="image" width="25" height="25">
             @else
                <input type="image" src="{{ asset('assets/images/edit_2.png') }}" onclick="editRecipe()" name="image" width="25" height="25">
             @endif
             <input type="image" src="{{ asset('assets/images/DeleteRed.png') }}" onclick="deleteRecipe()" name="image" width="25" height="25">
         </div>
         <div class="input-wrapper grey">
            <div>
                {!! Form::label('name','Recipe title',['class' => 'recipe-title']) !!}
            </div>
            {!! Form::text('name',$recipe == null ? '' : $recipe->name,['class' => 'recipe-input']) !!}
         </div>
         <div class="input-wrapper grey">
            <div>
                {!! Form::label('description','Description',['class' => 'recipe-title']) !!}
            </div>
            {!! Form::textarea('description',$recipe == null ? '' : $recipe->description,['class' => 'recipe-input']) !!}
         </div>
         <div class="input-wrapper grey">
            <div>
                {!! Form::label('servings','Servings',['class' => 'recipe-title']) !!}
            </div>
            {!! Form::text('servings',$recipe == null ? '' : $recipe->servings,['class' => 'recipe-input']) !!}
         </div>
         <div class="input-wrapper grey">
            <div>
                {!! Form::label('image','Image',['class' => 'recipe-title']) !!}
            </div>
            {!! Form::file('image',$recipe == null ? '' : $recipe->image) !!}
         </div>
         <section id="recipeDetail" hidden="{{ $recipe==null }}">
            <div class="input-wrapper grey">
               <div>
                   {!! Form::label('ingredients','Ingredients',['class' => 'recipe-title']) !!}
               </div>
               <div id='ingredients'>
                   <div class="input-row">
                       <div class="input-cell headercell-1">
                           <p class="lis-processed">Name</p>
                       </div>
                       <div class="input-cell headercell-2">
                           <p class="lis-processed">Detail</p>
                       </div>
                   </div>
                   <div id="row-1" class="input-row">   
                       <div class="input-cell cell-1">
                           {!! Form::select('ingredient-name-1', $ingredients) !!}
                       </div>
                       <div class="input-cell cell-2">
                           {!! Form::text('ingredient-detail-1',null,['class' => 'ingredient-detail-input']) !!}
                           <a id="delete-1" href=""><img width="18px;" src="{{ asset('assets/images/DeleteRed.png') }}"/></a>
                       </div>
                   </div>
               </div>
               <div><a class='addAnotherIngredient' href=""><img width="16px;" src="{{ asset('assets/images/plus.png') }}"/>ADD ANOTHER INGREDIENT</a></div>      
            </div>
             
            <div class="input-wrapper grey">
               <div>
                   {!! Form::label('steps','Steps',['class' => 'recipe-title']) !!}
               </div>

            </div>
         </section>
        </form>
   </div>
</div>    
 <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
 <script src="{{ asset("assets/js/recipe.js") }}" type="text/javascript"></script>
@stop