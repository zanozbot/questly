<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    
    protected $primaryKey = 'uid';
    public $timestamps = false;
    
    public function getAuthPassword() {
        return $this->password;
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment', 'uid');
    }
}
