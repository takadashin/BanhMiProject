<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class recipe extends Model{
    
    protected  $table ="recipe";
    public  $timestamps = false;
    protected $fillable = ['id','userpostid','name','servings','Description','img'];
    
    
    
}
