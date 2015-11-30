<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class recipe_ingre extends Model{
    
    protected  $table ="recipe_ingredient";
    protected $fillable = ['recipeid','ingredientid','detail'];
    public  $timestamps = false;  
}
