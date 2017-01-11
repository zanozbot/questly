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
    /**
    * Validates user input, checks for password
    * match, creates the user and logs the newly
    * created user in
    */
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
    
    /**
    * Validates user input, attemps to log the user 
    * in, if he has a role of admin, he is automatically
    * redirected to admin panel
    */
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
    
    /**
    * If the user is already logged in, he
    * is redirected back to index
    */
    public function register() {
        if(Auth::check()) {
            return redirect()->route('index');
        }else {
            return View::make('register');
        }
    }
    
    /**
    * If the user is already logged in, he
    * is redirected back to index
    */
    public function login() {
        if(Auth::check()) {
            return redirect()->route('index');
        }else {
            return View::make('login');
        }
    }
    
    /**
    * Log outs the user
    */
    public function logout() {
        if(Auth::check()) {
            Auth::logout();
        }
        return redirect()->back();
    }
    
    /**
    * Gets the user from database and all his 
    * questions and answered questions
    */
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
    
    /**
    * Returns all questions in the database,
    * for admin to review them
    */
    public function admin() {
        return View::make('admin')->with('questions', Question::all());
    }
}
