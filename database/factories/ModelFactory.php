<?php

use Illuminate\Support\Facades\Hash;

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
        'username'  => $faker->name,
        'email'     => $faker->email,
        'token'     => str_random(32),
        'password'  => Hash::make('secret'),
    ];
});

$factory->define(App\Camera::class, function (Faker\Generator $faker) {
    return [
        'camera_address' => $faker->macAddress,
        'building_id'    => factory(App\Building::class),
        'token'          => str_random(32),
    ];
});

$factory->define(App\Building::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->name,
        'campus_id' => factory(App\Campus::class),
    ];
});

$factory->define(App\Campus::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->name,
        'address'  => $faker->streetAddress,
        'city'     => $faker->city,
        'county'   => $faker->country,
        'postcode' => $faker->postcode,
    ];
});
