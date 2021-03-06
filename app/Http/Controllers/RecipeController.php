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
use Input;
use Auth;

class RecipeController extends Controller {
    
    public function  index(){
  
        $cds = DB::table('recipe')
        ->join('user', 'recipe.userpostid', '=', 'user.id')
        ->select(DB::raw('recipe.* ,user.avatar,user.username,'
                . ' (select COUNT(follow.id) from follow WHERE follow.followeduserid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.recipeid = recipe.id) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.recipeid = recipe.id and likes = true) as countlike  '))
        ->orderBy('recipe.datepost', 'DESC')->take(8)
        ->get();
        $db =  DB::table('recipe')
        ->join('user', 'recipe.userpostid', '=', 'user.id')
        ->select(DB::raw('recipe.* ,user.avatar,user.username,'
               . ' (select COUNT(follow.id) from follow WHERE follow.followeduserid = userpostid) as countfollow, '
                . '(select COUNT(made.id) from made WHERE made.recipeid = recipe.id) as countmade, '
                . '(select COUNT(vote.id) from vote WHERE vote.recipeid = recipe.id and likes = true) as countlike  '))
        ->orderBy('countlike')->take(8)
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
        ->orderBy('recipe.datepost', 'DESC')->paginate(16);
         
        
        return view('pages.recipe', ['recipe' => $cds]);
    } 
     public function  adminrecipe(){
         
        $cds = Recipe::orderBy('datepost','DESC')->paginate(12);
       
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
             $steps = Step::where('recipeid', $id)->orderBy('steporder','ASC')->get();
             $comments = comment::where('recipeid', '=', $id)->orderBy('created_at','desc')->get();
        $arrayingre = array();
        foreach($ingre as $row)
        {
            $arrayingre[$row->id] = $row->name;
        }
        
            return view('pages.admin.recipedetail',['recipe' => $recipe,'ingre' => $arrayingre,'step' => $steps,'comment'=>$comments]);
             
    } 
     public function  editcontentrecipe($id,Request $request){
        
            if(Auth::user()->isAdmin())
            {
                 $this->validate($request,
                [
                  'txt_title' => 'required',
                    'txt_serve' => 'required',
                    'txt_des' => 'required',
                 
                    
                ]
                );
            
            $inputs = $request->all();
            $checkfile = false;
            
            
            if (Input::hasFile('fileupload') && $inputs['fileupload']->isValid()) { 
           
            $destinationPath = 'assets/images/article_pic'; // upload path
            $extension = $inputs['fileupload']->getClientOriginalExtension(); // getting image extension
            $fileName = "recipe_".$id .rand (1,100 ). date("YmdHis", time()) . '.' . $extension; // renameing image
            $inputs['fileupload']->move($destinationPath, $fileName); // uploading file to given path
            $inputs['fileupload'] = $fileName;
            $checkfile = true;
            }
            
            $item = Recipe::find($id);
            $item->name = $inputs['txt_title'];
            $item->servings = $inputs['txt_serve'];
            $item->Description = $inputs['txt_des'];
            if($checkfile)
            {
                 $item->img = $inputs['fileupload'];
            }
            $item->save();
                return Redirect('admin/recipe');
            }
        else {
            return Redirect('index');
        }
             
    } 
     public function  search(Request $request){

            $inputs = $request->all();
            

            

            $query = DB::table('recipe')
            ->join('user', 'recipe.userpostid', '=', 'user.id')
//                    ->leftJoin('recipe_ingredient', 'recipe.id', '=', 'recipe_ingredient.recipeid')
//                    ->leftJoin('ingredient', 'ingredient.id', '=', 'recipe_ingredient.ingredientId')
            ->select(DB::raw('recipe.* ,user.avatar,user.username,'
                   . ' (select COUNT(follow.id) from follow WHERE follow.followeduserid = userpostid) as countfollow, '
                    . '(select COUNT(made.id) from made WHERE made.recipeid = recipe.id) as countmade, '
                    . '(select COUNT(vote.id) from vote WHERE vote.recipeid = recipe.id and likes = true) as countlike  '))
                    ->where(function($queryadd)
            {
                $qname = Input::get('txt_name');
                $searchTerms = explode(' ', $qname);
                if($qname != "")
                {
                foreach($searchTerms as $term)
                {
                    $queryadd->orWhere('recipe.name', 'LIKE', '%'. $term .'%');
                }
                }
            
            });
            //->where(function($queryadd)
//            {
//                $qingre = Input::get('txt_ingre');
//                $searchTerms = explode(' ', $qingre);
//                if($qingre != "")
//                {
//                foreach($searchTerms as $term)
//                {
//                    $queryadd->orWhere('ingredient.name', 'LIKE', '%'. $term .'%');
//                }
//                }
//            
//            });
           
               
                if(Input::get('txt_ingre') != "")
                {
                     $query->whereIn('recipe.id', function($queryadd)
                     {
                         $queryadd->select(DB::raw("recipeid"))
                        ->from('recipe_ingredient')->join('ingredient', 'ingredient.id', '=', 'recipe_ingredient.ingredientId');
                        $qingre = Input::get('txt_ingre');
                        $searchTerms = explode(' ', $qingre);
                        foreach($searchTerms as $term)
                        {
                            $queryadd->orWhere('ingredient.name', 'LIKE', '%'. $term .'%');
                        }
                     });
                }
            $qsort= Input::get('dd_size');
            if($qsort == "D")
                $query->orderBy('recipe.datepost', 'DESC');
            else if($qsort == "P")
                $query->orderBy('countlike', 'DESC');
            else
                $query->orderBy('countmade', 'DESC');
            
            //dd($query->toSql());
            $results = $query->paginate(16);
            
            return view('pages.recipe', ['recipe' => $results]);
             
    } 
    public function  addsteprecipe($id){

            return view('pages.admin.stepdetail',['recipeid' => $id]);
             
    } 
    public function  addstepdetail($id,Request $request){
        if(Auth::user()->isAdmin())
        {
            $this->validate($request,
                [
                  'txt_step_order' => 'required|alpha_num',
                    'txt_step_content'=> 'required'
                ]
                );
            
            $inputs = $request->all();
           
            if (Input::hasFile('picture') && $inputs['picture']->isValid()) { 
        
            $destinationPath = 'assets/images/article_pic'; // upload path
            $extension = $inputs['picture']->getClientOriginalExtension(); // getting image extension
            $fileName = "recipe_".$id .rand (1,100 ). date("YmdHis", time()) . '.' . $extension; // renameing image
            $inputs['picture']->move($destinationPath, $fileName); // uploading file to given path
            $inputs['picture'] = $fileName;
            }
            else
            {
                dd("error");
            }
            $item = new Step;
            $item->content = $inputs['txt_step_content'];
            $item->steporder = $inputs['txt_step_order'];
            $item->recipeid =$id;
            $item->picture = $inputs['picture'];
            $item->save();
            return Redirect('admin/recipe/edit/'.$id);
        }
        else {
            return Redirect('index');
        }
             
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
        $steps = Step::where('recipeid', $id)->orderBy('steporder','ASC')->get();
        $comments = comment::where('recipeid', '=', $id)->orderBy('created_at','desc')->get();
        $follow = Follow::where('followeduserid', $userstuff->id)->where('userid', $uid)->count();
        $made = Made::where('recipeid', $id)->where('userid', $uid)->count();
        $vote = Vote::where('recipeid', $id)->where('userid', $uid)->count();
        return view('pages.recipedetail', ['recipe' => $recipe,'usercheck' => $userstuff,'ingre' => $detailIngres,'steps' => $steps,'comments'=>$comments,'follow'=>$follow,'made'=>$made,'vote'=>$vote]);
    } 
 
    
}
