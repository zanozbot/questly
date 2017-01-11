<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @group unit
     */
    public function testCreateUser() {
        $user = factory(App\User::class)->create();
        $this->seeInDatabase('users', ['uid' => $user->uid]);
    }
    
    /**
     * @group unit
     */
    public function testDeleteUser() {
        $user = factory(App\User::class)->create();
        $user->delete();
        $this->notSeeInDatabase('users', ['uid' => $user->uid]);
    }
    
    /**
     * @group unit
     */
    public function testFetchUser() {
        $user = factory(App\User::class)->create();
        $this->assertEquals($user->username, User::find($user->uid)->username);
    }
    
    /**
     * @group unit
     */
    public function testUpdateUserInformation() {
        $user = factory(App\User::class)->create();
        $user->username = 'user.name';
        $user->save();
        $this->assertEquals(User::find($user->uid)->username, 'user.name');
    }

}
