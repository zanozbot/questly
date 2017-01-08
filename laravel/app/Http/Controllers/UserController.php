<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Question;

use App\Answer;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function postSignup(Request $req) {
        
        $this->validate($req, [
            'username' => 'required|max:30',
            'email' => 'email|unique:users|required|max:256',
            'password1' => 'required|min:8',
            'password2' => 'required|min:8'
        ]);
        
        $username = $req['username'];
        $email = $req['email'];
        $password1 = $req['password1'];
        $password2 = $req['password2'];
        
        if($password1 != $password2) {
            return redirect()->back();
        }
        
        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($password1);
        $user->email = $email;
        $user->role = "user";
        
        $user->save();
        
        Auth::login($user);
        
        return redirect()->route('index');
    }
    
    public function postLogin(Request $req) {
        $this->validate($req, [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $req['email'], 'password' => $req['password']], true)) {
            if(Auth::user()->role == 'admin') {
                return redirect()->route('admin');
            }else {
                return redirect()->route('index');
            }
        }
        
        return redirect()
                ->back()
                ->withErrors(['err' => 'Wrong username or password.'])
                ->withInput();;
    }
    
    public function register() {
        if(Auth::check()) {
            return redirect()->route('index');
        }else {
            return View::make('register');
        }
    }
    
    public function login() {
        if(Auth::check()) {
            return redirect()->route('index');
        }else {
            return View::make('login');
        }
    }
    
    public function logout() {
        if(Auth::check()) {
            Auth::logout();
        }
        return redirect()->back();
    }
    
    public function user($uid) {
        $user = User::find($uid);
        
        $answered = Answer::distinct('qid')->where('uid', $uid)->take(10)->pluck('qid')->toArray();
        
        $questionsAnswered = Question::findMany($answered);
        
        if($user) {
            return View::make('user')
                        ->with('user', $user)
                        ->with('questions', Question::where('uid', $uid)->take(10)->get())
                        ->with('answered', $questionsAnswered);
        }
        return redirect()->back();
    }
    
    public function admin() {
        return View::make('admin')->with('questions', Question::all());
    }
}
