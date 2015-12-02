<?php
namespace App\Http\Controllers;
use DB;
use App\Recipe;
use App\Comment;
use App\Follow;
use App\Made;
use App\Vote;
use App\Step;
use App\Recept_ingre;
use App\Ingredient;
use Illuminate\Http\Request;
use Auth;

class RecipeController extends Controller {
    
    public function  index(){
  
        $cds = DB::table('recipe')
        ->join('user', 'recipe.userpostid', '=', 'user.id')
        ->select(DB::raw('recipe.* ,user.avatar,user.username,'
                . ' (select COUNT(follow.id) from follow WHERE follow.followeduserid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.recipeid = recipe.id) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.recipeid = recipe.id and likes = true) as countlike  '))
        ->orderBy('recipe.datepost', 'DESC')->take(16)
        ->get();
        $db =  DB::table('recipe')
        ->join('user', 'recipe.userpostid', '=', 'user.id')
        ->select(DB::raw('recipe.* ,user.avatar,user.username,'
               . ' (select COUNT(follow.id) from follow WHERE follow.followeduserid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.recipeid = recipe.id) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.recipeid = recipe.id and likes = true) as countlike  '))
        ->orderBy('countlike')->take(16)
        ->get();
        return view('pages.index', ['recipe' => $cds,'popular' => $db]);
    }
    
     public function  recipe(){
         
        $cds = DB::table('recipe')
        ->join('user', 'recipe.userpostid', '=', 'user.id')
        ->select(DB::raw('recipe.* ,user.avatar,user.username,'
               . ' (select COUNT(follow.id) from follow WHERE follow.followeduserid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.recipeid = recipe.id) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.recipeid = recipe.id and likes = true) as countlike  '))
        ->orderBy('recipe.datepost', 'DESC')->paginate(9);
         
        
        return view('pages.recipe', ['recipe' => $cds]);
    } 
     public function  adminrecipe(){
         
        $cds = Recipe::orderBy('datepost')->paginate(9);
       
        return view('pages.admin.recipe', ['recipe' => $cds]);
    } 
     public function  deleterecipe($id){
        if(Auth::user()->isAdmin())
        {
            Vote::where('recipeid', $id)->delete();
            Made::where('recipeid', $id)->delete();
            Step::where('recipeid', $id)->delete();
            Recept_ingre::where('recipeid', $id)->delete();
            comment::where('recipeid', '=', $id)->delete();
            recipe::find($id)->delete();
            

            return Redirect('admin/recipe');
        }
        else {
            return Redirect('index');
        }
    } 
    public function  editrecipe($id){
        
            $recipe = recipe::find($id);
             $ingre = Ingredient::all();
        $arrayingre = array();
        foreach($ingre as $row)
        {
            $arrayingre[$row->id] = $row->name;
        }
        
            return view('pages.admin.recipedetail',['recipe' => $recipe,'ingre' => $arrayingre]);
             
    } 
    public function  detail($id){
        $uid;
       if(Auth::user() == null)
            $uid = -1;
        else
        {
            $uid = Auth::user()->id;
        }
        $recipe = recipe::find($id);
        $userstuff = $recipe->user;
        $detailIngres = $recipe->recept_ingre;
        $steps = $recipe->step;
        $comments = comment::where('recipeid', '=', $id)->orderBy('created_at','desc')->get();
        $follow = Follow::where('followeduserid', $userstuff->id)->where('userid', $uid)->count();
        $made = Made::where('recipeid', $id)->where('userid', $uid)->count();
        $vote = Vote::where('recipeid', $id)->where('userid', $uid)->count();
        return view('pages.recipedetail', ['recipe' => $recipe,'usercheck' => $userstuff,'ingre' => $detailIngres,'steps' => $steps,'comments'=>$comments,'follow'=>$follow,'made'=>$made,'vote'=>$vote]);
    } 
 
    
}
