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
        
        $sent = Mail::send('pages.emailverify', $inputs, function($message) use ($inputs)
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
    
    public function showProfile(){
        
        //$username = Session::get('username');
        $username = Auth::user()->username;
        
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
        //dd($cds);
        
        return view('pages.userprofile', ['userinfo' => $user, 'recipe' => $cds]);
    } 
    
    public function editProfile(Request $request)
    {
        $username = Auth::user()->username;
        $user = userrecipe::where('username','=',$username)->first();

        $this->validate($request,
                [
                    'avatar' => 'image|mimes:jpeg,jpg,bmp,png,gif|max:3000',
                    'firstname' => 'required|min:5',
                    'lastname' => 'required|min:5', 
                    'email' => 'required|email'
                ]
                );       
        
        $inputs = $request->all();
        if (Input::hasFile('avatar') && $inputs['avatar']->isValid()) { 
        
            $destinationPath = 'public/assets/images/user_pic'; // upload path
            $extension = $inputs['avatar']->getClientOriginalExtension(); // getting image extension
            $fileName = $inputs['username'] . date("YmdHis", time()) . '.' . $extension; // renameing image
            $inputs['avatar']->move($destinationPath, $fileName); // uploading file to given path
            $inputs['avatar'] = $fileName;
        }
        else
        {
            Flash::error('Update failed.');
        }
        
        
        $user->fill($inputs)->save();
        
        // sending back with message
        Flash::overlay('Update successfully');
        
        return Redirect('userprofile');
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
    
    public function sendContact(Request $request){
        $this->validate($request,
                [
                    'name' => 'required|min:5',
                    'email' => 'required|email',
                    'comment' => 'required|min:10'
                ]
                );
        $inputs = $request->all();  
        
        $inputs['senddate'] = date("Y-m-d H:i:s", time());
        
        //$user_id = DB::select('select id from user where username = ?', [$inputs['usersid']]);
        $user_id = userrecipe::where('username', '=', $inputs['usersid'])->first();
        
        if($user_id != null)
        {
//            $user_id = json_decode(json_encode($user_id), true);
//          $inputs['usersid'] = (int)$user_id[0];
            $inputs['usersid'] = $user_id['id'];
        }
        else
        {
            $inputs['usersid'] = NULL;
        }
        contact_message::create($inputs);
        
        Flash::overlay('Sending Successfully!!! Thank you for your commenting.');
        
        return Redirect('about');
    }
    
    public function listChefForUser(){
        if(Auth::check())
        {
            $username = Auth::user()->username;
            $users = userrecipe::where('username','<>', $username)->paginate(4);
        }
        else 
        {
//            $users = DB::table('user')->paginate(4);
            $users = userrecipe::paginate(4);
        }
        
        
        $recipes = Recipe::orderBy('datepost','desc')->get();
        foreach ($recipes as $r) {
            $userstuff = $r->user;
            $follow = Follow::where('followeduserid', $userstuff->id)->count();
            $made = Made::where('recipeid','=', $r->id)->count();
            $vote = Vote::where('recipeid','=', $r->id)->count();

            $recipe_quantity[] = array(
                'recId'=>$r->id,
                'follow'=>$follow,
                'made'=>$made,
                'vote'=>$vote
            );
        }
                
            
        $comments = Comment::all();
        return view('pages.cheflist', ['users' => $users,'recipes' => $recipes, 'comments'=>$comments,'recipe_quantity'=>$recipe_quantity]);
 
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
        
            $destinationPath = 'public/assets/images/user_pic'; // upload path
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
        
        // sending back with message
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
                    'email' => 'required|email',
                    'avatar' => 'image|mimes:jpeg,jpg,bmp,png,gif|max:3000'
                ]
                );       
        
        $inputs = $request->all();
        
        $inputs['password'] = Hash::make($inputs['password']);
        
        if (Input::hasFile('avatar') && $inputs['avatar']->isValid()) { 
        
            $destinationPath = 'public/assets/images/user_pic'; // upload path
            $extension = $inputs['avatar']->getClientOriginalExtension(); // getting image extension
            $fileName = $inputs['username'] . date("YmdHis", time()) . '.' . $extension; // renameing image
            $inputs['avatar']->move($destinationPath, $fileName); // uploading file to given path
            $inputs['avatar'] = $fileName;
        }
        else
        {
            Flash::error('Update failed.');
        }
        
        userrecipe::create($inputs);
        
        Flash::message('New Chef is created.');
        return Redirect::to('admin/chefs/list');
    }
    
    public function detailChef($id){
        $user = userrecipe::find($id);
        //Session::flash('modal_message_error','Show detail');
        return view('pages.admin.chefs.detail_chef', ['user' => $user]);
    }
    /**********************************************/
}


