<?php
namespace App\Http\Controllers;
use DB;
use App\Made;
use Auth;
use Illuminate\Http\Request;


class MadeController extends Controller {
    
    public function recipemade($rid)
    {if(Auth::user() == null)
            return Redirect('login');
        else
        {
            $uid = Auth::user()->id;
            $check = Made::where('recipeid', $rid)->where('userid', $uid)->count();
            if($check != 0)
            {
                Made::where('recipeid', $rid)->where('userid', $uid)->delete();
                echo "delete made";
            }
            else
            {
                $var = new Made;
                $var->recipeid = $rid;
                $var->userid = $uid;
                $var->save();
                echo "add made";
            }
            return Redirect('recipe/'.$rid);
        
        }
        
    }
    
}
