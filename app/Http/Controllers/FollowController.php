<?php
namespace App\Http\Controllers;
use DB;
use App\Follow;
use Auth;
use Illuminate\Http\Request;


class FollowController extends Controller {
    
    public function followchef($cid,$uid,$rid)
    {
        //return Auth::user()->id;
        $checkfollow = Follow::where('followeduserid', $cid)->where('userid', $uid)->count();
        if($checkfollow != 0)
        {
            Follow::where('followeduserid', $cid)->where('userid', $uid)->delete();
            echo "I delete";
        }
        else
        {
            $follow = new Follow;
            $follow->followeduserid = $cid;
            $follow->userid = $uid;
            $follow->save();
            echo "Add follow";
        }
        return Redirect('recipe/'.$rid);
        
        
        
    }
    
}
