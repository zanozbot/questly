<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Answer;


class AnswerTest extends TestCase
{
    
    use DatabaseTransactions;    
    
    /**
     * @group unit
     */
    public function testCreateAnswer()
    {
        $question = factory(App\Question::class)->create();
        $answer = factory(App\Answer::class)->create([
            'qid' => $question->qid
        ]);
        $this->seeInDatabase('answers', ['aid' => $answer->aid, 'qid' => $question->qid]);
    }
    
    /**
     * @group unit
     */
    public function testDeleteAnswer() {
        $question = factory(App\Question::class)->create();
        $answer = factory(App\Answer::class)->create([
            'qid' => $question->qid
        ]);
        $answer->delete();
        $this->notSeeInDatabase('answers', ['aid' => $answer->aid]);
    }
    
    /**
     * @group unit
     */
    public function testFetchAnswer() {
        $question = factory(App\Question::class)->create();
        $answer1 = factory(App\Answer::class)->create([
            'qid' => $question->qid
        ]);
        
        $answer2 = Answer::find($answer1->aid);
        
        $this->assertEquals($answer1->qid, $answer2->qid);
    }
    
    /**
     * @group unit
     */
    public function testUpdateInformationWithUser() {
        $question = factory(App\Question::class)->create();
        $user = factory(App\User::class)->create();
        $answer = factory(App\Answer::class)->create([
            'qid' => $question->qid,
            'uid' => $user->uid
        ]);
        
        $this->seeInDatabase('answers', [
            'aid' => $answer->aid,
            'qid' => $question->qid,
            'uid' => $user->uid
        ]);
    }
}
