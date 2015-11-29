<?php
namespace App\Http\Controllers;
use DB;
use App\vote;
use Auth;
use Illuminate\Http\Request;


class VoteController extends Controller {
    
    public function recipevote($rid)
    {if(Auth::user() == null)
            return Redirect('login');
        else
        {
            $uid = Auth::user()->id;
            $checklike = Vote::where('recipeid', $rid)->where('userid', $uid)->count();
            if($checklike != 0)
            {
                Vote::where('recipeid', $rid)->where('userid', $uid)->delete();
                echo "I delete";
            }
            else
            {
                $var = new Vote;
                $var->recipeid = $rid;
                $var->userid = $uid;
                $var->likes = 1;
                $var->save();
                echo "Add follow";
            }
            return Redirect('recipe/'.$rid);
        
        }
        
    }
    
}
