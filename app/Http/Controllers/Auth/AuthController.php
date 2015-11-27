<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Twitter\TwitterOAuth;

define('CONSUMER_KEY', 'PDZFwhSkvD2OPMvN3HxtmrwzH');
define('CONSUMER_SECRET', '7hQpqQMdfIq32R8mzGDFrZlQLWORntRrTkJsqFLcwo06CqRdBI');
define('OAUTH_CALLBACK', 'http://localhost:8000/auth/twitterLogin'); 

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    
    public function twitterLogin(){
        session_start();
        if (isset($_REQUEST['oauth_token']) && isset($_SESSION['token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {

             // if token is old, distroy any session and redirect user to index.php
              session_destroy();
             ///////////header('Location: ./index.php');
             return view("pages.home");

        }else if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

             // everything looks good, request access token
             //successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
             $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
             $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
             if($connection->http_code=='200')
             {
                 //redirect user to twitter
                // $_SESSION['status'] = 'verified';
                // $_SESSION['request_vars'] = $access_token;
               //  $_SESSION['username']=$access_token['screen_name'];
                 session(['username' => $access_token['screen_name']]);
                 // unset no longer needed request tokens
                 unset($_SESSION['token']);
                 unset($_SESSION['token_secret']);
                 ////////header('Location: ./index.php');
                 User::firstOrCreate(array('username'=>$access_token['screen_name'],'role'=>'user'));
                 return redirect("/");
             }else{
                 die("error, try again later!");
             }

        }else{

             if(isset($_GET["denied"]))
             {
                 ////header('Location: ./index.php');
                 return redirect("/");
                 die();
             }
            
             //fresh authentication
             $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
             $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

             //received token info from twitter
             $_SESSION['token']          = $request_token['oauth_token'];
             $_SESSION['token_secret']   = $request_token['oauth_token_secret'];

             // any value other than 200 is failure, so continue only if http code is 200
             if($connection->http_code=='200')
             {
                 //redirect user to twitter
                 $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
                ////// header('Location: ' . $twitter_url);
                 return redirect($twitter_url);
             }else{
                 die("error connecting to twitter! try again later!");
             }
        }
    }
    
    public function logout(){
        if(session()->has('username'))
            session ()->flush();
        return redirect("/");
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'role' => $data['role'],
        ]);
    }
}
