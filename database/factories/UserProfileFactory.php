<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'website' => $faker->randomElement(['https://laravel.com', 'https://certification.laravel.com', 'https://styde.net']),
        'job_title' => $faker->jobTitle,
    ];
});
