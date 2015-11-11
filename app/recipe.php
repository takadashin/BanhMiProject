<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class recipe extends Model{
    
    protected  $table ="recipes";
    public  $timestamps = false;
    protected $fillable = ['userpostid','name','servings'];
    
    
    
}
