<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ingredient;
use App\recipe;
use App\step;
use App\recipe_ingre;
use Request;

class PostRecipeController extends Controller {

    public $restful = true;

    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex($id = null) {

        $ingredients = ingredient::all();
        $ingredientArr = array();
        foreach ($ingredients as $ingredient) {
             $ingredientArr[$ingredient->id] = $ingredient->name;
        }
        
        $recipe = recipe::find($id);
        $recipeIngredients=null;
        $steps=null;
        if($recipe != null){
            $recipeIngredients = recipe_ingre::where('id',$recipe->id);
            $steps = step::where('id',$recipe->id);
        }
        
        return view("pages.postRecipe",['recipe'=>$recipe,'recipeIngredients'=>$recipeIngredients,'steps'=>$steps,'ingredients'=>$ingredientArr]);
    }

    public function getDeleteRecipe($id) {
        
    }

    public function postAdd() {
        if (Request::ajax()) {
            $date = new DateTime();
            $recipe = new recipe();
            $recipe->name = Request::input('name');
            $recipe->description = Request::input('description');
            $recipe->servings= Request::input('servings');
            $recipe->image=Request::input('image');
           // $recipe->datepost= $date;
            $recipe->id=  Auth::user()->id;
            $recipe->save();

            $last_recipe = $recipe->id;

            $recipes = recipe::whereId($last_recipe)->get();
            return "OK";
        }
    }

    public function postUpdateRecipe($id) {

        if (Request::ajax()) {

            $recipe = recipe::find($id);
            $this->setData($recipe);
            $recipe->save();
            return "OK";
        }
    }

    public function setData($recipe) {
        $recipe->userpostid = Auth::user()->id;
        $recipe->datepost = date("Y-m-d");
        $recipe->name = Request::input('name');
        $recipe->description = Request::input('description');
        $recipe->image = Request::input('image');
        $recipe->servings = Request::input('servings');
    }

}
