<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    $articleIds = App\Article::pluck('id')->toArray();
    $userIds = App\User::pluck('id')->toArray();

    return [
        'content'=>$faker->paragraph,
        'commentable_type'=> App\User::class,
        'commentable_id'=> function () use ($faker, $articleIds){
          return $faker ->randomElement($articleIds);
        },
        'user_id'=> function () use ($faker, $userIds){
          return $faker->randomElement($userIds);
        },
    ];
});
