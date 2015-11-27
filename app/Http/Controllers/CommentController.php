<?php
namespace App\Http\Controllers;
use DB;
use App\Comment;

use Illuminate\Http\Request;


class CommentController extends Controller {
    
    public function create(Request $request)
    {
        $this->validate($request,
                [
                  'description' => 'required|min:10',
                ]
                );
        $inputs = $request->all();
        Comment::create($inputs);
        dd($inputs);
        $id = $inputs::get('recipeid');
        return Redirect('recipe/'.$id);
    }
    
}
