<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Flash;
use App\userrecipe;
use App\contact_message;
use App\recipe;
use Redirect;
use Session;
use App\follow;
use App\made;
use App\vote;
use App\comment;
use App\recept_ingre;
class SearchController extends Controller {
    public function searchUser(Request $request){ 
        
        $inputs = $request->all();
        
        if($inputs['keyword'] == '')
        {
            $user = userrecipe::paginate();
        }
        else
        {
            $user = userrecipe::where('id', $inputs['keyword'])
                ->orWhere('username', $inputs['keyword'])
                ->orWhere('firstname', $inputs['keyword'])
                ->orWhere('lastname', $inputs['keyword'])
                ->orWhere('address' ,'Like', '%'.$inputs['keyword'].'%')
                ->orWhere('email', $inputs['keyword'])
                ->orWhere('phone', $inputs['keyword'])
                ->orWhere('role', $inputs['keyword'])->paginate();
        }
        
        if($user->count()==0)
        {
            Flash::error('Not Found!!!');
        }
        else {
            Flash::message('Found ' . $user->count() . ' user(s)');
        }
        
        return view('pages.admin.chefs.list_chef', ['user' => $user]);
    }
    
    
    public function searchContact(Request $request){ 
        $inputs = $request->all();
        
        if($inputs['keyword'] == '')
        {
            $contact = contact_message::paginate();
        }
        else
        {
            $contact = contact_message::where('id', $inputs['keyword'])
                ->orWhere('name', $inputs['keyword'])
                ->orWhere('subject', $inputs['keyword'])
                ->orWhere('usersid', $inputs['keyword'])
                ->orWhere('status', $inputs['keyword'])
                ->orWhere('email', $inputs['keyword'])->paginate();
        }
        
        if($contact->count()==0)
        {
            Flash::error('Not Found!!!');
        }
        else {
            Flash::message('Found ' . $contact->count() . ' contact(s)');
        }
        
        return view('pages.admin.contacts.list_contact', ['contact' => $contact]);
    }
    
    public function search(Request $request){ 
        $inputs = $request->all();
        
        if($inputs['keyword'] != '')
        {
            $recipes = recipe::where('name', 'Like', '%'.$inputs['keyword'].'%')->get();            
            
            $users = userrecipe::where('username','Like' ,'%'.$inputs['keyword'].'%')
                            ->where('role','<>','admin')
                            ->get();
            
            if($recipes->count()==0 && $users->count()==0)
            {
                Flash::error('Not Found!!!');
                return view('pages.search.resultlist', ['users' => null,'recipe_quantity'=>null]);
            }
            else if($users->count()!=0)
            {                
                Flash::message('Found ' . $users->count() . ' result(s)');             
                return Redirect::action('SearchController@listResultUser')->with('users', $users);
            }
            else
            {                
                Flash::message('Found ' . $recipes->count() . ' result(s)');             
                return Redirect::action('SearchController@listResultRecipe')->with('recipes', $recipes);
            }
        }
        else
        {
            return Redirect('/');
        }
    }
    
    public function listResultUser(){
        $users = Session::get( 'users' );
        $recipes = Recipe::orderBy('datepost','desc')->take(2)->get();
        foreach ($recipes as $r) {
            $userstuff = $r->user;
            $comments = comment::where('recipeid', '=', $r->id)->orderBy('created_at','desc')->take(3)->get();
            $follow = Follow::where('followeduserid', $userstuff->id)->count();
            $made = Made::where('recipeid','=', $r->id)->count();
            $vote = Vote::where('recipeid','=', $r->id)->count();
            
            $recipe_quantity[] = array(
                'rec'=>$r,
                'follow'=>$follow,
                'made'=>$made,
                'vote'=>$vote,
                'comments'=>$comments
            );
            
        }        
        return view('pages.search.resultlist', ['users' => $users,'recipe_quantity'=>$recipe_quantity]);
    }
    
    public function listResultRecipe(){
        $recipes = Session::get('recipes');   
        
        foreach ($recipes as $r) {
            $userstuff = $r->user;
            $comments = comment::where('recipeid', '=', $r->id)->orderBy('created_at','desc')->take(3)->get();
            $follow = Follow::where('followeduserid', $userstuff->id)->count();
            $made = Made::where('recipeid','=', $r->id)->count();
            $vote = Vote::where('recipeid','=', $r->id)->count();
            
            $recipe_quantity[] = array(
                'rec'=>$r,
                'follow'=>$follow,
                'made'=>$made,
                'vote'=>$vote,
                'comments'=>$comments
            );

            $r_id[] = $r->id;         
        }
        
        $users = userrecipe::distinct()
                ->join('recipe', 'user.id', '=', 'recipe.userpostid')
                ->select('user.*')
                ->whereIn('recipe.id', $r_id)                
                ->get();
        
        return view('pages.search.resultlist', ['users' => $users,'recipe_quantity'=>$recipe_quantity]);
    }
}

