<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class comment extends Model{
    protected  $table ="comment";
    public function user()
    {
        return $this->hasOne('App\userrecipe','id','userpostid');
    }
    
    
}
