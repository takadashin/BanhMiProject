<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
use App\Recipe;
use Auth;
//use Illuminate\Http\Request;
use Request;

class AdminRecipeController extends Controller {
   public $restful = true;
   
   public function postDeleteingre() {

        if(Request::ajax()){
        $rid = Request::input("recipeid");
        $gid= Request::input("ingreid");
//        Recept_ingre::where('recipeid', $rid)->where('ingredientId',$gid)->delete();
        $recipe = recipe::find($rid);
        return view('pages.admin.IngreListData',['recipe' => $recipe]);

        }
    }
    
}
