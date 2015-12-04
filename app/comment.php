<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class comment extends Model{
    protected  $table ="comment";
    protected $fillable = [ 'userpostid', 'recipeid', 'content'];
    public function user()
    {
        return $this->hasOne('App\userrecipe','id','userpostid');
    }
    
    //Huyen
    public function recipe()
    {
        return $this->belongsTo('App\recipe');
    }
    
}
