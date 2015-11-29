<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Ingredient;
use Request;


class IngredientController extends Controller{
    public $restful = true;


    public function getIndex() {
        $ingredients = Ingredient::all();
        return view("pages.admin.ingredient")
                ->with("ingredients", $ingredients);               
    }

    public function getDelete($id) {
        
        if(Request::ajax()){

        $ingredient = Ingredient::whereId($id)->first();
        $ingredient->delete();
        return "OK";

        }
    }

    public function postAdd() {    
        if(Request::ajax()){

            $ingredient = new Ingredient();
            $ingredient->name = Request::input('name');
            $ingredient->save();

            $last_ingredient = $ingredient->id;

            $ingredients = Ingredient::whereId($last_ingredient)->get();

            return view("pages.admin.ajaxIngredientData")
                    ->with("ingredients", $ingredients);
        }


    }

    public function postUpdate($id) {
        
        if(Request::ajax()){

        $ingredient = Ingredient::find($id);
        $ingredient->name = Request::input('name');
        $ingredient->save();
        return "OK";
        
        }
    }
}
