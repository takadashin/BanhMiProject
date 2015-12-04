<?php

namespace App\Http\Controllers;
use App\contact_message;
use App\userrecipe;
use App\comment;
use App\follow;
use App\made;
use App\vote;
use App\step;
use App\recept_ingre;
use View;
use Validator;
use Session;
use Illuminate\Http\Request;
use Mail;
use Hash;
use Flash;
use Redirect;
use DB;
use Input;
use App\Recipe;
use Auth;

class UserController extends Controller {
    /*******************Huyen**********************/
    public function createUser(Request $request){   
        $this->validate($request,
                [
                    'firstname' => 'required|min:5',
                    'lastname' => 'required|min:5',
                    'username' => 'required|min:5|unique:user',
                    'password' => 'required|min:6',
                    'confirmpassword' => 'required|min:6|same:password',
                    'email' => 'required|email'
                ]
                );       
        
        $inputs = $request->all();
        
        $confirmation_code = str_random(30);
        
        $inputs['role'] = 'user';
        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['confirmation_code'] = $confirmation_code;
        
        userrecipe::create($inputs);
        
        Mail::send('pages.emailverify', $inputs, function($message) use ($inputs)
        {
            $message->from("uh6062@gmail.com", "allstartrecipe");
            $message->to($inputs['email'], $inputs['firstname'].' '.$inputs['lastname'])
                    ->subject('Verify your email address');

        });
        
        Flash::message('Thanks for signing up! Please check your email to verify email.');          
        return Redirect::to('register/confirmation'); 
    }
    
    public function confirm($confirmation_code){
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = userrecipe::where('confirmation_code','=',$confirmation_code)->first();

        if (!$user)
        {
            Flash::error('Sorry. The verify code has been used. Please try another one.');
        }
        else{
            $user->confirmed = 1;
            $user->confirmation_code = null;
            $user->save();

            Flash::overlay('You have successfully verified your account.');
        }
        
        return Redirect::to('register/confirmation');

    } 
    
    public function showProfile($username){
        $user = userrecipe::where('username','=',$username)->first();
        
        if($user['role']=='admin')
        {
            $cds = DB::table('recipe')
            ->join('user', 'recipe.userpostid', '=', 'user.id')
            ->select(DB::raw('recipe.* ,user.avatar,user.username,'
                    . ' (select COUNT(follow.id) from follow WHERE follow.userid = userpostid) as countfollow, '
                    . '(select COUNT(made.id) from made WHERE made.userid = userpostid) as countmade, '
                    . '(select COUNT(vote.id) from vote WHERE vote.userid = userpostid and likes = true) as countlike '))
            ->orderBy('recipe.datepost', 'desc')
            ->paginate(6);
        }
        else
        {
            $cds = DB::table('recipe')
            ->join('user', 'recipe.userpostid', '=', 'user.id')
            ->select(DB::raw('recipe.* ,user.avatar,user.username,'
                    . ' (select COUNT(follow.id) from follow WHERE follow.userid = userpostid) as countfollow, '
                    . '(select COUNT(made.id) from made WHERE made.userid = userpostid) as countmade, '
                    . '(select COUNT(vote.id) from vote WHERE vote.userid = userpostid and likes = true) as countlike '))
            ->where('recipe.userpostid','=', $user['id'])
            ->orderBy('recipe.datepost', 'desc')
            ->paginate(6);
            
        }
        return view('pages.userprofile', ['userinfo' => $user, 'recipe' => $cds]);
    }  
    
    public function editProfile(Request $request)
    {
        $this->validate($request,
                [
                    'avatar' => 'image|mimes:jpeg,jpg,bmp,png,gif|max:3000',
                    'firstname' => 'required|min:5',
                    'lastname' => 'required|min:5', 
                    'email' => 'required|email'
                ]
                );       
        
        $inputs = $request->all();
        
        $user = userrecipe::where('id','=',$inputs['id'])->first();
        
        if (Input::hasFile('avatar') && $inputs['avatar']->isValid()) { 
            
            $destinationPath = 'assets/images/user_pic'; // upload path
            $extension = $inputs['avatar']->getClientOriginalExtension(); // getting image extension
            $fileName = $inputs['username'] . date("YmdHis", time()) . '.' . $extension; // renameing image
            $inputs['avatar']->move($destinationPath, $fileName); // uploading file to given path
            $inputs['avatar'] = $fileName;
        }
        else
        {
            Flash::overlay('Update failed.');
        }
        
        $user->fill($inputs)->save();
        
        Flash::overlay('Update successfully');        
        return Redirect::to('/userprofile/' . $user->username);
        
    }
    
    public function deleteRecipe($id)
    {          
        Vote::where('recipeid', $id)->delete();
        Made::where('recipeid', $id)->delete();
        Step::where('recipeid', $id)->delete();
        Recept_ingre::where('recipeid', $id)->delete();
        Comment::where('recipeid', '=', $id)->delete();
        Recipe::find($id)->delete();
        Flash::overlay('Delete successfully');
        return Redirect::to('userprofile');
    }
    
    public function listChefForUser(){
        $users = userrecipe::where('role','<>','admin')->paginate(3);
        $recipes = Recipe::orderBy('datepost','desc')->get();
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
        return view('pages.cheflist', ['users' => $users,'recipe_quantity'=>$recipe_quantity]); 
    }
    
    
    public function listChefForAdmin(){
        $users = DB::table('user')->orderBy('id','desc')->paginate(3);
        //return view('pages.admin.chefs', ['user' => $users]);
        return view('pages.admin.chefs.list_chef', ['user' => $users]);
    }
    
    public function editChef($id){
        return view('pages.admin.chefs.edit_chef', ['user' => userrecipe::find($id)]);
    }
    
    public function updateChef(Request $request){
        $user = userrecipe::where('id','=',Input::get('id'))->first();
        
        $this->validate($request,
                [
                    'avatar' => 'image|mimes:jpeg,jpg,bmp,png,gif|max:3000',
                    'firstname' => 'required|min:5',
                    'lastname' => 'required|min:5',
                    'password' => 'required|min:6',
                    'email' => 'required|email'
                ]
                );       
        
        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);

        if (Input::hasFile('avatar') && $inputs['avatar']->isValid()) { 
        
            $destinationPath = 'assets/images/user_pic'; // upload path
            $extension = $inputs['avatar']->getClientOriginalExtension(); // getting image extension
            $fileName =$user['username'] . date("YmdHis", time()) . '.' . $extension; // renameing image
            $inputs['avatar']->move($destinationPath, $fileName); // uploading file to given path
            $inputs['avatar'] = $fileName;
        }
        else
        {
            Flash::error('Update failed.');
        }
        
        $user->fill($inputs)->save();
        Flash::overlay('Update successfully');        
        return Redirect('admin/chefs/list');
    }

    public function deleteChef($id)
    {    
        Vote::where('userid', $id)->delete();
        Made::where('userid', $id)->delete();
        Follow::where('userid', $id)->delete();
        contact_message::where('usersid', $id)->delete();
        Comment::where('userpostid', '=', $id)->delete();
        Recipe::where('userpostid', '=', $id)->delete();
        userrecipe::find($id)->delete();
        Flash::overlay('Delete successfully');
        return Redirect::to('admin/chefs/list');
    }

    public function createChef(Request $request){   
        $this->validate($request,
                [
                    'firstname' => 'required|min:5',
                    'lastname' => 'required|min:5',
                    'username' => 'required|min:5|unique:user',
                    'password' => 'required|min:6',
                    'email' => 'required|email'                    
                ]
                );       
        
        $inputs = $request->all();
        
        $inputs['password'] = Hash::make($inputs['password']);
        
        userrecipe::create($inputs);
        
        Flash::message('New Chef is created.');
        return Redirect::to('admin/chefs/list');
    }
    
    public function detailChef($id){
        $user = userrecipe::find($id);
        return view('pages.admin.chefs.detail_chef', ['user' => $user]);
    }
    /**********************************************/
}


