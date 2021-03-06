<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function(Faker $faker) {
    return [
        'type_id' => function() {
            $userTypes = \App\Models\UserType::all();
            $userType = $userTypes->random(1)->first();

            return $userType->id;
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'password', // password
        'remember_token' => Str::random(10),
    ];
});
