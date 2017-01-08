<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $primaryKey = 'qid';
    const UPDATED_AT = null;
    const CREATED_AT = 'timestamp';
    
    public function comments()
    {
        return $this->hasMany('App\Comment','qid');
    }
}
