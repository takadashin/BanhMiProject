<?php
namespace App\Http\Controllers;
use DB;
use App\Comment;
use Auth;
use Illuminate\Http\Request;


class CommentController extends Controller {
    
    public function create(Request $request)
    {
        if(Auth::user() == null)
            return Redirect('login');
        else
        {
            $this->validate($request,
                [
                  'description' => 'required|min:10',
                ]
                );
        $inputs = $request->all();
        $item = new Comment;
        $item->content = $inputs['description'];
        $item->recipeid = $inputs['recipeid'];
        $item->userpostid = Auth::user()->id;;
        $item->save();
        $id = $inputs['recipeid'];

        return Redirect('recipe/'.$id);
        }
    }
    
}
