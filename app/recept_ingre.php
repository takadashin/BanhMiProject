<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class recept_ingre extends Model{
    
    protected  $table ="recipe_ingredient";
    public  $timestamps = false;
    public function ingredient()
    {
        return $this->hasOne('App\ingredient','id','ingredientId');
    }
}
