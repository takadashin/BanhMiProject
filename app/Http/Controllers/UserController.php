<?php

namespace App\Http\Controllers;
use App\contact_message;
use App\userrecipe;
use Illuminate\Http\Request;
use Mail;
use Hash;
use Flash;
use Redirect;
use Session;
use DB;
use Input;
use App\Recipe;
use View;
use Validator;
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
            ->orderBy('recipe.datepost')
            ->get();
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
            ->orderBy('recipe.datepost')
            ->get();
        }
        //dd($cds);
        
        return view('pages.userprofile', ['userinfo' => $user, 'recipe' => $cds]);
    } 
    
    public function editProfile(Request $request)
    {
        //$username = Session::get('username');
        
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
    
    public function deleteRecipe()
    {        
        Recipe::find(Input::get('id'))->delete();
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
        
        var_dump($user_id['id']);
        
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
    
//    public function upload() {
//        // getting all of the post data
//        $file = array('image' => Input::file('image'));
//        // setting up rules
//        $rules = array('image' => 'required|image|mimes:jpeg,jpg,bmp,png,gif|max:3000',);
//        
//        $validator = Validator::make($file, $rules);
//        if ($validator->fails()) {
//          // send back to the page with the input data and errors
//          return Redirect::to('userprofile')->withInput()->withErrors($validator);
//           
//        }
//        else {
//          // checking file is valid.
//          if (Input::file('image')->isValid()) {
//            $destinationPath = 'public/assets/images/user_pic'; // upload path
//            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
//            $fileName = Input::get('username') . date("YmdHis", time()) . '.' . $extension; // renameing image
//            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
//            // sending back with message
//            Flash::overlay('Upload successfully');
//          }
//          else 
//           {
//            // sending back with error message.
//            Flash::overlay('Uploaded file is not valid');
//            
//          }
//        }
//        return Redirect::to('/userprofile');
//
//
//    }
    
    public function paging() {
        $recipes = recipe::paginate(2);
        return View::make('pages.userprofile', compact('recipes'));
    }


    
    public function listChef(){
        return view('pages.cheflist');
    }
    
   /**********************************************/
}


