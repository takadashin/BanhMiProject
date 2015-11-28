<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\User;
use App\Twitter\TwitterOAuth;
use \Illuminate\Support\Facades\Redirect;

define('CONSUMER_KEY', 'PDZFwhSkvD2OPMvN3HxtmrwzH');
define('CONSUMER_SECRET', '7hQpqQMdfIq32R8mzGDFrZlQLWORntRrTkJsqFLcwo06CqRdBI');
define('OAUTH_CALLBACK', 'http://localhost:8000/twitterLogin');

class SessionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /* show page user login*/
    public function create() {
        return view('pages.login');
    }
    
    /* show page admin login*/
    public function adminLogin() {
        return view('pages.admin.login');
    }

    /* admin login */

    public function adminStore(Request $request) {
        $inputs = $request->all();

        Auth::attempt(array("username" => $inputs['username'], "password" => $inputs['password'], "role" => User::$ADMIN_ROLE, "confirmed" => "1"));
        if (Auth::check())
            return redirect("/admin");
        else
            return Redirect::back()->with("login_error", "Invalid Username and Password");
    }

    /* user login */

    public function store(Request $request) {
        $inputs = $request->all();
        $user = User::firstOrNew(array("username" => $inputs['username']));
        if ($user->id == null || $user->role == User::$TWITTER_ROLE) {
            return Redirect::back()->with("login_error", "Username is not exist");
        }
        Auth::attempt(array("username" => $inputs['username'], "password" => $inputs['password'],"confirmed" => "1"));
        if (Auth::check())
            return redirect("/");
        else
            return Redirect::back()->with("login_error", "Invalid Password");
    }

    public function twitterLogin() {
        session_start();
        if (isset($_REQUEST['oauth_token']) && isset($_SESSION['token']) && $_SESSION['token'] !== $_REQUEST['oauth_token']) {

            // if token is old, distroy any session and redirect user to index.php
            session_destroy();
            return view("pages.home");
        } else if (isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

            // everything looks good, request access token
            //successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'], $_SESSION['token_secret']);
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if ($connection->http_code == '200') {
                //redirect user to twitter
                // unset no longer needed request tokens
                unset($_SESSION['token']);
                unset($_SESSION['token_secret']);

                $user = User::firstOrNew(array("username" => $access_token['screen_name']));
                if ($user->id == null) {
                    $user = User::Create(array('username' => $access_token['screen_name'], 'password' => Hash::make(' '), 'role' => User::$TWITTER_ROLE, 'confirmed' => '1'));
                }
                Auth::login($user);
                return redirect("/");
            } else {
                die("error, try again later!");
            }
        } else {

            if (isset($_GET["denied"])) {
                return redirect("/");
                die();
            }

            //fresh authentication
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

            //received token info from twitter
            $_SESSION['token'] = $request_token['oauth_token'];
            $_SESSION['token_secret'] = $request_token['oauth_token_secret'];

            // any value other than 200 is failure, so continue only if http code is 200
            if ($connection->http_code == '200') {
                //redirect user to twitter
                $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
                return redirect($twitter_url);
            } else {
                die("error connecting to twitter! try again later!");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy() {
        $admin = Auth::user()->isAdmin();
        Auth::logout();
        if ($admin) {
            return redirect("/admin");
        }
        return redirect("/");
    }

}
