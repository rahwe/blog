<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
        'is_admin' => false
    ];
});

$factory->state(App\User::class, 'rahwee', function(Faker $faker){
    return [
        'name' => 'rahwee',
        'email' => 'rahweekh@gmail.com',
        'is_admin' => true
        // for example if you let laravel create randomly 
        // only the content, so you can delete content key
        // and value below. So New title will stay the same
        // and content laravel will random as setted in define above.
        //'content' => 'New Content'
    ];
});
