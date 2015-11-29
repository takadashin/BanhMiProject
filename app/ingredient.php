<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class ingredient extends Model{   
    protected  $table ="ingredient";
    protected $fillable = ['name'];
    public  $timestamps = false;  
}
