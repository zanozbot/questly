<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Question;

class QuestionTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @group unit
     */
    public function testCreateQuestion()
    {
        $question = factory(App\Question::class)->create();
        $this->seeInDatabase('questions', ['qid' => $question->qid]);
    }
    
    /**
     * @group unit
     * Also covers the update test
     */
    public function testCreateQuestionWithUser()
    {
        $user = factory(App\User::class)->create();
        $question = factory(App\Question::class)->create();
        $question->uid = $user->uid;
        $question->save();
        $this->seeInDatabase('questions', ['qid' => $question->qid, 'uid' => $question->uid]);
    }
    
    /**
     * @group unit
     */
    public function testDeleteQuestion() {
        $question = factory(App\Question::class)->create();
        $question->delete();
        $this->notSeeInDatabase('questions', ['qid' => $question->qid]);
    }
    
    /**
     * @group unit
     */
    public function testFetchQuestion() {
        $question1 = factory(App\Question::class)->create();
        $question2 = Question::find($question1->qid);
        $this->assertEquals($question1->title, $question2->title);
    }
    
}
