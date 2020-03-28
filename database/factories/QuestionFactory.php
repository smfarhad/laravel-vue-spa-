<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use App\User;
use App\Model\Question;
use App\Model\Category;
use Illuminate\Support\Str;

$factory->define(Question::class, function (Faker $faker) {
    $question = $faker->sentence;
    return [
        'title' => $question,
        'slung' => Str::slug($question),
        'body'  => $faker->text,
        'category_id' => function(){
            return Category::all()->random();
        },
        'user_id' => function(){
            return User::all()->random();
        }
    ];
});
