<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->username,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => (rand(0,1) == 1) ? 'user' : 'admin'
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'votes' => rand(0,10),
        'views' => rand(0,100),
        'replies' => rand(0,5),
        'title' => $faker->sentence(6),
        'content' => $faker->text
    ];
});

$factory->define(App\Answer::class, function (Faker\Generator $faker) {
    return [
        'votes' => rand(0,10),
        'content' => $faker->text
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->text
    ];
});