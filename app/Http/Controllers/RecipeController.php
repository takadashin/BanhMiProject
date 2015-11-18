<?php
namespace App\Http\Controllers;
use DB;
use App\Recipe;
use Illuminate\Http\Request;


class RecipeController extends Controller {
    public function  index(){
        $cds =  DB::select('SELECT recipe.*,user.avatar,user.username,'
                . ' (select COUNT(follow.id) from follow WHERE follow.userid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.userid = userpostid) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.userid = userpostid and likes = true) as countlike '
                . 'FROM recipe,user where recipe.userpostid = user.id order by recipe.datepost LIMIT 16');
        $db =  DB::select('SELECT recipe.*,user.avatar,user.username,'
                . ' (select COUNT(follow.id) from follow WHERE follow.userid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.userid = userpostid) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.userid = userpostid and likes = true) as countlike '
                . 'FROM recipe,user where recipe.userpostid = user.id order by countlike LIMIT 16');
        return view('pages.index', ['recipe' => $cds,'popular' => $db]);
    }
    
    
}
