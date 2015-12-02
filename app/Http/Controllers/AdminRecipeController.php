<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
use App\Recipe;
use App\Recept_ingre;
use Auth;
//use Illuminate\Http\Request;
use Request;

class AdminRecipeController extends Controller {
   public $restful = true;
   
   public function postDeleteingre() {

        if(Request::ajax()){
        $rid = Request::input("recipeid");
        $gid= Request::input("ingreid");
        Recept_ingre::where('recipeid', $rid)->where('id',$gid)->delete();
        $recipe = recipe::find($rid);
        return view('pages.admin.IngreListData',['recipe' => $recipe]);

        }
    }
    public function postEditingre() {

        if(Request::ajax()){
        $rid = Request::input("recipeid");
        $gid= Request::input("ingreid");
        $detail= Request::input("detail");
        $rowneed = Recept_ingre::where('id',$gid)->first();
        $rowneed->detail = $detail;
        $rowneed->save();
        $recipe = recipe::find($rid);
        return view('pages.admin.IngreListData',['recipe' => $recipe]);

        }
    }
    public function postAddingre() {

        if(Request::ajax()){
        $rid = Request::input("recipeid");
        $gid= Request::input("ingreid");
        $detail= Request::input("detail");
        $rowneed = new Recept_ingre;
        $rowneed->recipeid = $rid;
        $rowneed->ingredientId = $gid;
        $rowneed->detail = $detail;
        $rowneed->save();
        $recipe = recipe::find($rid);
        return view('pages.admin.IngreListData',['recipe' => $recipe]);

        }
    }
}
