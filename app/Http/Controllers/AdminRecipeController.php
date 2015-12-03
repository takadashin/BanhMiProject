<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
use App\Recipe;
use App\Recept_ingre;
use App\Step;
use App\Comment;
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
    public function postDeletecomment() {

        if(Request::ajax()){
        $rid = Request::input("recipeid");
        $sid= Request::input("commentid");
        Comment::where('id',$sid)->delete();
        $recipe = recipe::find($rid);
        $comments = comment::where('recipeid', '=', $rid)->orderBy('created_at','desc')->get();
        return view('pages.admin.CommentListData',['recipe' => $recipe,'comment'=>$comments]);

        }
    }
    public function postEditcomment() {

        if(Request::ajax()){
        $rid = Request::input("recipeid");
        $sid= Request::input("commentid");
        $detail= Request::input("detail");
        
       
        $rowneed =  Comment::where('id',$sid)->first();
        $rowneed->content = $detail;
        $rowneed->save();
        $recipe = recipe::find($rid);
        $comments = comment::where('recipeid', '=', $rid)->orderBy('created_at','desc')->get();
        return view('pages.admin.CommentListData',['recipe' => $recipe,'comment'=>$comments]);
        }
    }
    public function postDeletestep() {

        if(Request::ajax()){
        $rid = Request::input("recipeid");
        $sid= Request::input("stepid");
        Step::where('id',$sid)->delete();
        $recipe = recipe::find($rid);
        $steps = Step::where('recipeid', $rid)->orderBy('steporder','ASC')->get();
        return view('pages.admin.StepListData',['recipe' => $recipe,'step'=>$steps]);

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
    public function postEditstep() {

        if(Request::ajax()){
        $rid = Request::input("recipeid");
        $sid= Request::input("stepid");
        $detail= Request::input("detail");
        
       
        $rowneed =  Step::where('id',$sid)->first();
        $rowneed->content = $detail;
        $rowneed->save();
        $recipe = recipe::find($rid);
        $steps = Step::where('recipeid', $rid)->orderBy('steporder','ASC')->get();
        return view('pages.admin.StepListData',['recipe' => $recipe,'step'=>$steps]);

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
