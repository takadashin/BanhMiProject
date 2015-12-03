<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Flash;
use App\userrecipe;
use App\contact_message;
use App\recipe;

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
            $recipe = recipe::where('name', 'Like', $inputs['keyword'])->paginate();            
            
            $user = userrecipe::where('username','Like' ,$inputs['keyword'])->paginate();
            
            if($recipe->count()==0 && $user->count()==0)
            {
                Flash::error('Not Found!!!');
            }
            else {
                
                Flash::message('Found ' . $contact->count() . ' contact(s)');
            }

            return view('pages.admin.contacts.list_contact', ['contact' => $contact]);
            
            
        }
        else
        {
            return Redirect('/');
        }
        
        
    }
}

