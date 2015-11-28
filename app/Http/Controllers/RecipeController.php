<?php
namespace App\Http\Controllers;
use DB;
use App\Recipe;
use App\Comment;
use App\Follow;
use App\Made;
use App\Vote;
use Illuminate\Http\Request;


class RecipeController extends Controller {
    public function  index(){
//        $cds =  DB::select('SELECT recipe.*,user.avatar,user.username,'
//                . ' (select COUNT(follow.id) from follow WHERE follow.userid = userpostid) as countfollow, '
//                . '(select COUNT(made.id) from made WHERE made.userid = userpostid) as countmade, '
//                . '(select COUNT(vote.id) from vote WHERE vote.userid = userpostid and likes = true) as countlike '
//                . 'FROM recipe,user where recipe.userpostid = user.id order by recipe.datepost LIMIT 16');
        
        $cds = DB::table('recipe')
        ->join('user', 'recipe.userpostid', '=', 'user.id')
        ->select(DB::raw('recipe.* ,user.avatar,user.username,'
                . ' (select COUNT(follow.id) from follow WHERE follow.userid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.userid = userpostid) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.userid = userpostid and likes = true) as countlike '))
        ->orderBy('recipe.datepost')->take(16)
        ->get();
        $db =  DB::table('recipe')
        ->join('user', 'recipe.userpostid', '=', 'user.id')
        ->select(DB::raw('recipe.* ,user.avatar,user.username,'
                . ' (select COUNT(follow.id) from follow WHERE follow.userid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.userid = userpostid) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.userid = userpostid and likes = true) as countlike '))
        ->orderBy('countlike')->take(16)
        ->get();
        return view('pages.index', ['recipe' => $cds,'popular' => $db]);
    }
    
     public function  recipe(){
         
        $cds = DB::table('recipe')
        ->join('user', 'recipe.userpostid', '=', 'user.id')
        ->select(DB::raw('recipe.* ,user.avatar,user.username,'
                . ' (select COUNT(follow.id) from follow WHERE follow.userid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.userid = userpostid) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.userid = userpostid and likes = true) as countlike '))
        ->orderBy('recipe.datepost')->paginate(9);
         
        
        return view('pages.recipe', ['recipe' => $cds]);
    } 
    public function  detail($id){
        $recipe = recipe::find($id);
        $userstuff = $recipe->user;
        $detailIngres = $recipe->recept_ingre;
        $steps = $recipe->step;
        $comments = comment::where('recipeid', '=', $id)->orderBy('created_at','desc')->get();
        $follow = Follow::where('followeduserid', $userstuff->id)->where('userid', 1)->count();
        $made = Made::where('recipeid', $id)->where('userid', 1)->count();
        $vote = Vote::where('recipeid', $id)->where('userid', 1)->count();
        return view('pages.recipedetail', ['recipe' => $recipe,'usercheck' => $userstuff,'ingre' => $detailIngres,'steps' => $steps,'comments'=>$comments,'follow'=>$follow,'made'=>$made,'vote'=>$vote]);
    } 
    
    
}
