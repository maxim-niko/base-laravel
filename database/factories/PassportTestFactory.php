<?php

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

$factory->define(\Laravel\Passport\Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'secret' => str_random(40),
        'redirect' => 'http://localhost',
        'personal_access_client' => 0,
        'password_client' => 1,
        'revoked' => 0,
    ];
});
