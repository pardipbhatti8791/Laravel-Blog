<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$IGwRMOfERqP9t8fdCtUx6.G0yR04HwtICJUEl6g09Nqt/tpJ9n0QK', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(App\User::class, 'gugu', function (Faker $faker) {
    return [
        'name'  =>  'Gagan J B',
        'email' =>  'gaganj@gmail.com'
    ];
});
