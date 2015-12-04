<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class userrecipe extends Model{
    protected  $table ="user";
    public  $timestamps = false;
    protected $fillable = ['username','password', 'firstname', 'lastname', 'address', 'email', 'phone','role','avatar', 'remember_token', 'confirmation_code', 'confirmed'];
    public function contact_messages()
    {
        return $this->hasMany('App\contact_message');
    }
    
}
