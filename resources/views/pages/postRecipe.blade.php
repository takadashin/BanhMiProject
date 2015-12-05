@extends('layouts.main')

@section('title')
    Post Recipe Page
@stop

@section('content')
<div class="innerwrap">
    <div class="header_title">
        <h1>CREATE RECIPE</h1>
    </div>
    <div id="recipeContianer"> 
        @if($recipe == null)
           {!! Form::open(array('url'=>'postRecipe/addrecipe/','method'=>'POST', 'files'=>true)) !!}
       @endif
             <div id="button">
                @if($recipe == null)
                    <input type="image" src="{{ asset('assets/images/plus.png') }}" onclick="addRecipe()" name="image" width="25" height="25"/>
                @else
                   <input type="image" src="{{ asset('assets/images/edit_2.png') }}" onclick="updateRecipe({{ $recipe->id }})" name="image" width="25" height="25"/>
                   <a href="{{ url("postRecipe/deleterecipe",$recipe->id) }}"><input type="image" src="{{ asset('assets/images/DeleteRed.png') }}" name="image" width="25" height="25"></a>
                @endif                 
             </div>
       @if($recipe != null)
           {!! Form::open(array('url'=>'postRecipe/updaterecipe/' . $recipe->id,'method'=>'POST', 'files'=>true, 'id' => 'recipeForm')) !!}
       @endif
           
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
                {!! Form::textarea('description',$recipe == null ? '' : $recipe->Description,['class' => 'recipe-input']) !!}
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
                 {!! Form::file('img',['accept'=>'.jpg,.png', 'onChange' => 'changeImage(this,"Recipe")' ]) !!}
                 <img id="{{ 'stepImageRecipe'}}" style="height:85px;width:85px;" src="{{ asset('assets/images/article_pic/' . ($recipe == null ? '' : $recipe->img)) }}" />
             </div>
        {!! Form::close() !!}
        
        
        @if($recipe != null)  
         <section id="recipeDetail">
            
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
                   @foreach($recipeIngredients as $recipeIngredient)
                    <div class="input-row">   
                        <div class="input-cell cell-1">
                            {!! Form::select('ingredientId' . $recipeIngredient->id, $ingredients,$recipeIngredient->ingredientId) !!}
                        </div>
                        <div class="input-cell cell-2">
                            {!! Form::text('detail' . $recipeIngredient->id,$recipeIngredient->detail,['class' => 'ingredient-detail-input']) !!}

                        </div>
                        <div class="input-cell cell-3">
                            <input class="updateButton" type="image" src="{{ asset('assets/images/edit_2.png') }}" onclick="updateIngredient({{ $recipeIngredient->id }})" name="image" width="25" height="25"/>
                            <a id="delete" href="{{ url("postRecipe/deleteingredient",$recipeIngredient->id) }}"><img width="18px;" src="{{ asset('assets/images/DeleteRed.png') }}"/></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                  
                <div><a class='addAnotherIngredient' href="{{ url('postRecipe/addingredient', $recipe->id) }}"><img width="16px;" src="{{ asset('assets/images/plus.png') }}"/>ADD ANOTHER INGREDIENT</a></div>      
            </div>
              
            
             
            <div class="input-wrapper grey">
               <div>
                   {!! Form::label('steps','Steps',['class' => 'recipe-title']) !!}
               </div>
               <div id='steps'>
                   <div class="input-row">
                       <div class="input-cell headercell-1">
                           <p class="lis-processed">Order</p>
                       </div>
                       <div class="input-cell headercell-2">
                           <p class="lis-processed">Content</p>
                       </div>
                       <div class="input-cell headercell-3">
                           <p class="lis-processed">Picture</p>
                       </div>
                   </div>
                   @foreach($steps as $step)
                    <div class="input-row"> 
                        {!! Form::open(array('url'=>'postRecipe/updatestep/' . $step->id,'method'=>'POST', 'files'=>true, 'id' => 'stepForm')) !!}
                        <div class="input-cell cell-1">
                            {!! Form::text('steporder' . $step->id, $step->steporder ,['class' =>  'step-order']) !!}

                        </div>
                        <div class="input-cell cell-2">
                            {!! Form::textarea('content' . $step->id,$step->content,['class' => 'step-content']) !!}
                        </div>
                         <div class="input-cell cell-3">
                            {!! Form::file('picture' . $step->id,['id'=>'stepImg' .$step->id ,'accept'=>'.jpg,.png', 'onChange' => 'changeImage(this,'.$step->id .')' ]) !!}
                            <img id="{{ 'stepImage' .  $step->id }}" style="height:85px;width:85px;" src="{{ asset('assets/images/article_pic/' . $step->picture) }}" /> 
                        </div>
                        
                        <div class="input-cell cell-4">
                            <input class="updateButton" type="image" src="{{ asset('assets/images/edit_2.png') }}" onclick="updateStep({{ $step->id }})" name="image" width="25" height="25"/>
                            <a id="delete" href="{{ url("postRecipe/deletestep",$step->id) }}"><img width="18px;" src="{{ asset('assets/images/DeleteRed.png') }}"/></a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endforeach
                </div>
                <div><a class='addAnotherIngredient' href="{{ url('postRecipe/addstep', $recipe->id) }}"><img width="16px;" src="{{ asset('assets/images/plus.png') }}"/>ADD ANOTHER STEP</a></div>      
           </div>
        </section>
        @endif       
    </div>
</div>  
 <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
 <script src="{{ asset("assets/js/recipe.js") }}" type="text/javascript"></script>
@stop
