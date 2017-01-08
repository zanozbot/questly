<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Question;

use App\User;

use App\Answer;

use App\Comment;

use App\Library\Arkanite;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;

class QuestionController extends Controller
{
    public function createNewQuestion(Request $req) {
        $this->validate($req, [
            'title' => 'required|max:128',
            'question' => 'required'
        ]);
        
        $question = new Question();
        $question->title = $req['title'];
        $question->content = $req['question'];
        if(Auth::check()) {
            $question->uid = Auth::user()->uid;
        }
        
        $question->save();
        
        return redirect()->route('question', ['qid' => $question->qid]);
    }
    
    public function delete($qid) {
        $question = Question::find($qid);
        if($question) {
            $question->delete();
        }
        
        return redirect()->back();
    }
    
    public function question($qid) {
        $arkanite = new Arkanite();
        
        $question = Question::find($qid);
        if($question) {
            
            $user = 'Anonymous';
            if($question->uid) {
                $user = User::find($question->uid)->username;
            }
            
            $QuestionComments = Question::find($question->qid)->comments;
            
            $answers = Answer::where('qid', $qid)->get();
            foreach($answers as $answer) {
                $username = 'Anonymous';
                if($answer->uid) {
                    $username = User::find($answer->uid)->username;
                }
                $answer->setAttribute('username', $username);
                $answer->content = $arkanite->parse($answer->content);
            }
            
            $views = $question->views + 1;
            
            $question->views = $views;
            $question->save();
            
            $question->content = $arkanite->parse($question->content);
            
            return View::make('question')
                    ->with('question', $question)
                    ->with('username', $user)
                    ->with('answers', $answers);
        }
        return redirect()->back();
    }
    
    public function search(Request $req) {
        if(empty($req->query('query'))) {
            return redirect()->back();
        }
        
        // split on 1+ whitespace & ignore empty (eg. trailing space)
        $searchValues = preg_split('/\s+/', $req->query('query'), -1, PREG_SPLIT_NO_EMPTY);
        
        $questions = Question::where(function ($q) use ($searchValues) {
          foreach ($searchValues as $value) {
            $q->orWhere('title', 'like', "%{$value}%");
          }
        })->take(5)->get();
        
        return View::make('search')
                    ->with('questions', $questions)
                    ->with('query', $req->query('query'));
    }
    
    public function index() {
        $top = Question::all()
                        ->sortByDesc("votes")
                        ->take(10);
        
        $new = Question::all()
                        ->sortBy("timestamp")
                        ->take(4);
        
        return View::make('index')
                    ->with('top', $top)
                    ->with('new', $new);
    }
    
    public function upvote($qid) {
        $this->vote($qid, true);
        return redirect()->back();
    }
    
    public function downvote($qid) {
        vote($qid, false);
        return redirect()->back();
    }
    
    private function vote($qid, $add) {
        $question = Question::find($qid);
        if($question) {
            if($add) {
                $votes = $question->votes + 1;
            }else {
                $votes = $question->votes - 1;
            }
            
            $question->votes = $votes;
            $question->save();
        }
    }
}
