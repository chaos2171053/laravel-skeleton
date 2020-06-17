<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$hBDx/arKmSEuzTp2M1oIIuFnXPkYabGm7JY1Nw7dSwaBcD941CUvG', // 12345678
        'remember_token' => Str::random(10),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});