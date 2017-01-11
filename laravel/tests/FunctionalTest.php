<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FunctionalTest extends TestCase
{
    
    use DatabaseTransactions;
    
    /**
     * @group functional
     */
    public function testVisitIndex()
    {
        $this->visit('/')
             ->see('Questly | Response and Reply');
    }
    
    /**
     * @group functional
     */
    public function testVisitLogin() {
        $this->visit('/')
            ->click('Log in')
            ->see('Log in to Questly');
    }
    
    /**
     * @group functional
     */
    public function testTryToLogin() {
        $this->visit('/login')
         ->type('test@gmail.com', 'email')
         ->type('Test123!', 'password')
         ->press('Log in')
         ->seePageIs('/')
         ->see('Welcome, tester');
    }
    
    /**
     * @group functional
     */
    public function testVisitRegister() {
        $this->visit('/register')
            ->see('Create your Questly account.')
            ->see('Already have an account?');
    }
    
    /**
     * @group functional
     */
    public function testInsertQuestionVisitIndex() {
        $question = factory(App\Question::class)->create();
        $this->visit('/')
            ->see($question->title);
    }
    
    /**
     * @group functional
     */
    public function testRegisterANewUserVisitUserPage() {
        $user = factory(App\User::class)->make();
        
        $this->visit('/register')
         ->type($user->username, 'username')
         ->type($user->email, 'email')
         ->type($user->password, 'password1')
         ->type($user->password, 'password2')
         ->press('Sign up')
         ->seePageIs('/')
         ->click('Welcome, ' + $user->username)
         ->see($user->username);
    }
    
    /**
     * @group functional
     */
    public function testAddQuestionAndAnswer() {
        $question = factory(App\Question::class)->make();
        $answer = factory(App\Answer::class)->make();
        
        $this->visit('/new')
            ->type($question->title, 'title')
            ->type($question->content, 'question')
            ->press('Post your question')
            ->see($question->title)
            ->see('0 Answer')
            ->type($answer->content, 'content')
            ->press('Post your reply')
            ->see($question->title)
            ->see($answer->content)
            ->see('1 Answer')
            ->dontSee('0 Answer');
    }
    
    /**
     * @group functional
     */
    public function testRatingQuestion() {
        $question = factory(App\Question::class)->create();
        
        $this->visit('/question/'.$question->qid)
            ->see('<h1>'.$question->title.'</h1>')
            ->see('<span>'.$question->votes.'</span>')
            ->click('▼')
            ->see('<span>'.($question->votes - 1).'</span>')
            ->click('▲')
            ->see('<span>'.$question->votes.'</span>');
    }
    
    /**
     * @group functional
     */
    public function testAddCommentToAQuestion() {
        $question = factory(App\Question::class)->create();
        $comment = factory(App\Comment::class)->make();
        
        $this->visit('/question/'.$question->qid)
            ->see('<h1>'.$question->title.'</h1>')
            ->click('#question-'.$question->qid)
            ->type($comment->content, 'comment')
            ->press('Comment')
            ->see($comment->content);
    }
    
    /**
     * @group functional
     */
    public function testRatingAnswers() {
        $question = factory(App\Question::class)->create();
        $answer = factory(App\Answer::class)->create([
            'qid' => $question->qid
        ]);
        
        $this->visit('/question/'.$question->qid)
            ->visit('/answer/'.$answer->aid.'/downvote')
            ->see('<span>'.($answer->votes - 1).'</span>')
            ->visit('/answer/'.$answer->aid.'/upvote')
            ->see('<span>'.$answer->votes.'</span>');
    }
    
    /**
     * @group functional
     */
    public function testVisitAdminPanelWithMiddleware() {
        $this->visit('/admin')
            ->seePageIs('/');
    }
    
    /**
     * @group functional
     */
    public function testVisitAdminPanelWithoutMiddleware() {
        $this->withoutMiddleware()
            ->visit('/admin')
            ->seePageIs('/admin');
    }
    
    /**
     * @group functional
     */
    public function testDeleteQeustionWithoutMiddleware() {
        $question = factory(App\Question::class)->create();
        
        $this->withoutMiddleware()
            ->visit('/admin')
            ->press('Delete - '.mb_strimwidth($question->title, 0, 10, '...'))
            ->notSeeInDatabase('questions', ['qid' => $question->qid]);
    }
    
}
