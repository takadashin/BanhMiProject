@extends('layouts.admin')

@section('Ingredient')
    Home Page
@stop

@section('headerTitle')
    Ingredient
@stop

@section('content')
    
    <div class="container">
     <section id="form_section">	
        <form id="add_ingredient" class="ingredient" style="display:none">
            <input id="name" type="text" name="name" placeholder="Enter a ingredient name" value=""/>
            <button name="submit">Add Ingredient</button>
        </form>

        <form id="edit_ingredient" class="ingredient" style="display:none">
                    <input id="edit_ingredient_id" type="hidden" value="" />
            <input id="edit_ingredient_name" type="text" name="name" value="" />
            <button name="submit">Edit Ingredient</button>
        </form>

    </section>
    <section id="data_section" class="ingredient">
      <ul class="ingredient-controls">
        <li><img src="{{ asset("assets/images/add.png") }}" width="14px" onClick="show_form('add_ingredient');" /></li>
      </ul>
      <ul id="ingredient_list" class="ingredient-list">
      	@foreach($ingredients as $ingredient)
            <li id="{{$ingredient->id}}"></a> <span id="span_{{$ingredient->id}}">{{$ingredient->name}}</span> <a href="#" onClick="delete_ingredient('{{$ingredient->id}}');" class="icon-delete">Delete</a> <a href="#" onClick="edit_ingredient('{{$ingredient->id}}','{{$ingredient->name}}');" class="icon-edit">Edit</a></li>
        @endforeach
      </ul>
    </section>  
  </div>
  <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
 <script src="{{ asset("assets/js/ingredient.js") }}" type="text/javascript"></script>
@stop

