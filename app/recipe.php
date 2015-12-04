<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class recipe extends Model{
    
    protected  $table ="recipe";
    public  $timestamps = false;
    protected $fillable = [ 'userpostid', 'name', 'servings', 'Description', 'img', 'datepost'];
    
    public function user()
    {
        return $this->hasOne('App\userrecipe','id','userpostid');
    }
    
    public function recept_ingre()
    {
        return $this->hasMany('App\recept_ingre','recipeid');
    }
    public function step()
    {
        return $this->hasMany('App\step','recipeid');
    }
    public function comment()
    {
        return $this->hasMany('App\comment','recipeid');
    }
    
    //Huyen
    public function users()
    {
        return $this->belongto('App\userrecipe');
    }
}
