<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Flash;
use DB;
use Mail;
use App\contact_message;
use App\userrecipe;

class ContactController extends Controller {
    public function listContact(){
        $contact = DB::table('contact_message')->orderBy('senddate','desc')->paginate(3);
        //return view('pages.admin.chefs', ['user' => $users]);
        return view('pages.admin.contacts.list_contact', ['contact' => $contact]);
    }
    
    public function detailContact($id){
        $contact = contact_message::find($id);
        
        DB::table('contact_message')
            ->where('id', $id)
            ->update(['status'=>'read']);
        
        return view('pages.admin.contacts.detail_contact', ['contact' => $contact]);
    }
    
    public function sendContact(Request $request){
        $this->validate($request,
                [
                    'name' => 'required|min:5',
                    'email' => 'required|email',
                    'subject' => 'required|min:10',
                    'comment' => 'required|min:15'
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
        
        Mail::send([], $inputs, function($message) use ($inputs)
        {
            $message->from("uh6062@gmail.com", "allstartrecipe");
            $message->to($inputs['email'], $inputs['name'])
                    ->subject('do-not-reply.')
                    ->setBody('Thanks for your contacting with us.<br/>'
                            . 'This is the automatically replying when you send a contact to us.'
                            . 'Just let you know that we will contact to you soon.<br/>'
                            . 'Regards.');

        });
        
        
        Flash::overlay('Sending Successfully!!! Thank you for your commenting.');
        
        return Redirect('about');
    }
    
    
    public function replyContact(Request $request){
        $this->validate($request,
                [
                    'reply_content' => 'required|min:5'
                ]
                );  
        $inputs = $request->all();  
        
        $inputs['replydate'] = date("Y-m-d H:i:s", time());
        $inputs['status'] = 'replied';
                
        
        Mail::send([], $inputs, function($message) use ($inputs)
        {
            $message->from("uh6062@gmail.com", "allstartrecipe");
            $message->to($inputs['email'], $inputs['name'])
                    ->subject('Reply for your comment.')
                    ->setBody($inputs['reply_content']);

        });
        
        $contact = contact_message::where('id','=',$inputs['id'])->first();
        $contact->fill($inputs)->save();
        
        Flash::overlay('Reply is sent.');
        
        return Redirect('admin/contacts/list');
    }
    
    public function deleteContact($id)
    {
        contact_message::find($id)->delete();
        Flash::overlay('Delete successfully');
        return Redirect('admin/contacts/list');
    }
}

