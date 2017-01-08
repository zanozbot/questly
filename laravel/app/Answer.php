<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $primaryKey = 'aid';
    const UPDATED_AT = null;
    const CREATED_AT = 'timestamp';
    
    public function comments()
    {
        return $this->hasMany('App\Comment', 'aid');
    }
}
