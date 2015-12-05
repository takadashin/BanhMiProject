<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ingredient;
use App\recipe;
use App\step;
use App\recipe_ingre;
use Request;
use Auth;
use App\comment;
use App\Made;
use App\Vote;
use Input;

use \Illuminate\Support\Facades\Redirect;


class PostRecipeController extends Controller {

    public $restful = true;

    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex() {
        $id= Request::input('id');
        $ingredients = ingredient::all();
        $ingredientArr = array();
        foreach ($ingredients as $ingredient) {
             $ingredientArr[$ingredient->id] = $ingredient->name;
        }
        
        $recipe = recipe::find($id);
        $recipeIngredients = null;
        $steps=null;
        if($recipe != null){
            $recipeIngredients = recipe_ingre::where('recipeid',$recipe->id)->get();
            $steps = Step::where('recipeid', $recipe->id)->orderBy('steporder','ASC')->get();
        }
        
        return view("pages.postRecipe",['recipe'=>$recipe,'recipeIngredients'=>$recipeIngredients,'steps'=>$steps,'ingredients'=>$ingredientArr]);
    }

    public function postAddrecipe() {      
        $recipe = new recipe();
        $recipe->name = Request::input('name');
        $recipe->description = Request::input('description');
        $recipe->servings = Request::input('servings');
        $recipe->datepost = date('Y-m-d H:i:s',time());
        $recipe->userpostid = Auth::user()->id;
        
        $file = Input::file('img');

        if (Input::hasFile('img') && $file->isValid()) {     
            $imgFolder = 'assets/images/article_pic';
            $extension = $file->getClientOriginalExtension();
            $fileName = "recipe_user". Auth::user()->id .rand (1,100 ). date("YmdHis", time()) . '.' . $extension;
            $file->move($imgFolder, $fileName); // uploading file to given path
            $recipe->img = $fileName;
        }
        $recipe->save();
        return redirect('/postRecipe?id=' . $recipe->id);
    }
    
    public function getDeleterecipe($id) {
        Vote::where('recipeid', $id)->delete();
        Made::where('recipeid', $id)->delete();
        step::where('recipeid', $id)->delete();
        recipe_ingre::where('recipeid', $id)->delete();
        comment::where('recipeid', '=', $id)->delete();
        recipe::find($id)->delete();
        return  redirect('/userprofile/' .Auth::user()->username);
        
    }

    public function postUpdaterecipe($id) {
        $recipe = recipe::find($id);
        $inputs = Input::all();
        $recipe->name = $inputs['name'];
        $recipe->description = $inputs['description'];
        $recipe->servings = $inputs['servings'];
        $recipe->datepost = date('Y-m-d H:i:s',time());
        $recipe->userpostid = Auth::user()->id;
        
        $file = Input::file('img');

        if (Input::hasFile('img') && $file->isValid()) {     
            $imgFolder = 'assets/images/article_pic';
            $extension = $file->getClientOriginalExtension();
            $fileName = "recipe_".$id .rand (1,100 ). date("YmdHis", time()) . '.' . $extension;
            $file->move($imgFolder, $fileName); // uploading file to given path
            $recipe->img = $fileName;
       }
       
        $recipe->save();
        return redirect('/postRecipe?id=' . $id);
    }
    
    public function getAddingredient($recipeid) {      
        $recipeIngredient = new recipe_ingre();
        $recipeIngredient->recipeid = $recipeid;
        if(ingredient::all() != null)
            $recipeIngredient->ingredientid = ingredient::all()->first()->id;
        $recipeIngredient->save();
        return redirect('/postRecipe?id=' . $recipeid);
    }
    
    public function getDeleteingredient($id) {
        $recipeIngredient = recipe_ingre::find($id);
        $recipeId = $recipeIngredient->recipeid;
        $recipeIngredient->delete();
        return redirect('/postRecipe?id=' . $recipeId);
    }

    public function postUpdateingredient($id) {
        $recipeIngredient = recipe_ingre::find($id);
        $recipeIngredient->ingredientid = Request::input('ingredientId');
        $recipeIngredient->detail = Request::input('detail');
        $recipeIngredient->save();
        return $recipeIngredient->recipeid;
    }
    
    public function getAddstep($recipeid) {      
        $step = new step();
        $step->recipeid = $recipeid;
        $step->save();
        return redirect('/postRecipe?id=' . $recipeid);
    }
    
    public function getDeletestep($id) {
        $step = step::find($id);
        $recipeId = $step->recipeid;
        $step->delete();
        return redirect('/postRecipe?id=' . $recipeId);
    }

    public function postUpdatestep($id) {
        $step = step::find($id);
        $inputs = Input::all();
        $step->content = $inputs['content' . $id];
        $step->steporder = $inputs['steporder'. $id];
        $file = Input::file('picture' . $id);
 
        if (Input::hasFile('picture' . $id) && $file->isValid()) {     
            $imgFolder = 'assets/images/article_pic';
            $extension = $file->getClientOriginalExtension();
            $fileName = "step_recipe".$id .rand (1,100 ). date("YmdHis", time()) . '.' . $extension;
            $file->move($imgFolder, $fileName); // uploading file to given path
            $step->picture = $fileName;
       }
        
        $step->save();
        return redirect('/postRecipe?id=' . $step->recipeid);
    }

    
}
