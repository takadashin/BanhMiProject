<?php
namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;


class RecipeController extends Controller {
    public function  index(){
        $cds = Recipe::all();
        return view('pages.index')->with('recipe',$cds);
    }
    
    
}
