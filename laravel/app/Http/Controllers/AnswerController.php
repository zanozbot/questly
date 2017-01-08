<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Answer;

use App\Question;

use App\Http\Requests;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function createNewAnswer(Request $req) {
        $this->validate($req, [
            'content' => 'required',
            'qid' => 'required'
        ]);
        
        $answer = new Answer();
        
        if(Auth::check()) {
            $answer->uid = Auth::user()->uid;
        }
        
        $answer->qid = $req['qid'];
        $answer->content = $req['content'];
        
        $answer->save();
        
        $question = Question::find($req['qid']);
        $question->replies = $question->replies + 1;
        $question->save();
        
        return redirect()->route('question', ['qid' => $req['qid']]);
    }
    
    public function upvote($aid) {
        $this->vote($aid, true);
        return redirect()->back();
    }
    
    public function downvote($aid) {
        $this->vote($aid, false);
        return redirect()->back();
    }
    
    private function vote($aid, $add) {
        $answer = Answer::find($aid);
        if($answer) {
            if($add) {
                $votes = $answer->votes + 1;
            }else {
                $votes = $answer->votes - 1;
            }
            
            $answer->votes = $votes;
            $answer->save();
        }
    }
}
