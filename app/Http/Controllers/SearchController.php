<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Flash;
use App\userrecipe;

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
                ->orWhere('address', $inputs['keyword'])
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
}

