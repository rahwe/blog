<?php

use Faker\Generator as Faker;

// define is used when you don't care about your specific value
// you let laravel randomly make your value

$factory->define(App\BlogPost::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'content' => $faker->paragraphs(5, true),
        'created_at' => $faker->dateTimeBetween('-3 months')
    ];
});

// state in laravel is different from define.
// state is used to make your own some value specific.

$factory->state(App\BlogPost::class, 'new-title', function(Faker $faker){
    return [
        'title' => 'New title',
        // for example if you let laravel create randomly 
        // only the content, so you can delete content key
        // and value below. So New title will stay the same
        // and content laravel will random as setted in define above.
        //'content' => 'New Content'
    ];
});
