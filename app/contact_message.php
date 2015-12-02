<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class contact_message extends Model {
    
    protected  $table ="contact_message";
    public  $timestamps = false;
    protected $fillable = ['name','email','comment', 'senddate', 'usersid', 'status'];
    
    public function users()
    {
        return $this->belongsTo('App\userrecipe');
    }
    
    
}


