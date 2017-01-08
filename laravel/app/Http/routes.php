<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
    'uses' => 'QuestionController@index',
    'as' => 'index'
]);

// Start: login
Route::get('login', [
    'uses' => 'UserController@login',
    'as' => 'login'
]);

Route::post('login', [
    'uses' => 'UserController@postLogin',
    'as' => 'postLogin'
]);
// End: login

Route::get('logout', [
    'uses' => 'UserController@logout',
    'as' => 'logout'
]);

// Start: register
Route::get('register', [
    'uses' => 'UserController@register',
    'as' => 'register'
]);

Route::post('register', [
    'uses' => 'UserController@postSignup',
    'as' => 'postSignup'
]);
// End: register

Route::get('new', function () {
    return view('new');
})->name('new');

Route::get('user/{uid}', [
    'uses' => 'UserController@user',
    'as' => 'user'
]);

Route::post('question/new', [
    'uses' => 'QuestionController@createNewQuestion',
    'as' => 'createNewQuestion'
]);

Route::get('question/{qid}', [
    'uses' => 'QuestionController@question',
    'as' => 'question'
]);

Route::get('question/{qid}/upvote', [
    'uses' => 'QuestionController@upvote',
    'as' => 'questionUpvote'
]);

Route::get('question/{qid}/downvote', [
    'uses' => 'QuestionController@downvote',
    'as' => 'questionDownvote'
]);

Route::get('search', [
   'uses' => 'QuestionController@search',
   'as' => 'search'
]);

Route::post('answer/new', [
    'uses' => 'AnswerController@createNewAnswer',
    'as' => 'createNewAnswer'
]);

Route::get('answer/{aid}/upvote', [
    'uses' => 'AnswerController@upvote',
    'as' => 'answerUpvote'
]);

Route::get('answer/{aid}/downvote', [
    'uses' => 'AnswerController@downvote',
    'as' => 'answerDownvote'
]);

Route::post('comment/new', [
    'uses' => 'CommentController@createNewComment',
    'as' => 'createNewComment'
]);

Route::get('admin', [
    'uses' => 'UserController@admin',
    'as' => 'admin',
    'middleware' => 'role',
    'role' => 'admin'
]);

Route::get('question/{qid}/delete', [
    'uses' => 'QuestionController@delete',
    'as' => 'deleteQuestion',
    'middleware' => 'role',
    'role' => 'admin'
]);