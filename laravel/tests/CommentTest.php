<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    use DatabaseTransactions; 
    
    /**
     * @group unit
     */
    public function testCreateComment()
    {
        $comment = factory(App\Comment::class)->create();
        $this->seeInDatabase('comments', ['cid' => $comment->cid]);
    }
    
    /**
     * @group unit
     */
    public function testDeleteComment() {
        $comment = factory(App\Comment::class)->create();
        $comment->delete();
        $this->notSeeInDatabase('comments', ['cid' => $comment->cid]);
    }
    
    /**
     * @group unit
     */
    public function testCommentUserRelation()
    {
        $user = factory(App\User::class)->create();
        $comment = factory(App\Comment::class)->create([
            'uid' => $user->uid
        ]);
        $this->assertEquals($comment->content, $user->comments->first()->content);
    }
    
    /**
     * @group unit
     */
    public function testCommentQuestionRelation() {
        $question = factory(App\Question::class)->create();
        $comment = factory(App\Comment::class)->create([
            'qid' => $question->qid
        ]);
        $this->assertEquals($comment->content, $question->comments->first()->content);
    }
    
    /**
     * @group unit
     */
    public function testCommentAnswerRelation() {
        $question = factory(App\Question::class)->create();
        $answer = factory(App\Answer::class)->create([
            'qid' => $question->qid
        ]);
        $comment = factory(App\Comment::class)->create([
            'aid' => $answer->aid
        ]);
        
        $this->assertEquals($comment->content, $answer->comments->first()->content);
    }
}
