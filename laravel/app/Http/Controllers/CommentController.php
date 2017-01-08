<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    public function createNewComment(Request $req) {
        $this->validate($req, [
            'comment' => 'required'
        ]);
        
        $qid = $req['qid'];
        $aid = $req['aid'];
        
        if(!$qid && !$aid) {
            return redirect()->back();
        }
        
        $comment = new Comment();
        $comment->content = $req['comment'];
        
        if($qid) {
            $comment->qid = $qid;
        }
        
        if($aid) {
            $comment->aid = $aid;
        }
        
        if(Auth::check()) {
            $comment->uid = Auth::user()->uid;
        }
        
        $comment->save();
        
        return redirect()->back();
    }
}
