<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class step extends Model{
    protected  $table ="step";
    protected $fillable = ['recipeid','content',"picture"];
    public  $timestamps = false;  
    
}
