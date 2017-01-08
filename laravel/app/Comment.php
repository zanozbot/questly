<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'cid';
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo('App\User', 'uid');
    }
    
    public function question()
    {
        return $this->belongsTo('App\Question', 'qid');
    }
    
    public function answer()
    {
        return $this->belongsTo('App\Answer', 'aid');
    }
}
