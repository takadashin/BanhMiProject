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
        return $this->hasMany('App\recept_ingre');
    }
  
    
}
