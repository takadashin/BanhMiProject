<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class recipe extends Model{
    
    protected  $table ="recipe";
    public  $timestamps = false;
    protected $fillable = ['id', 'userpostid', 'name', 'servings', 'Description', 'img', 'datepost'];
    
    public function user()
    {
        return $this->hasOne('user');
    }
    
}
