<?php

/**
 * @var $faker \Faker\Generator
 * @var $index 0..30
 */
return [
    'owner_id' => $faker->numberBetween($min = 1, $max = 5),
    'about_me' => $faker->text,
    'profile_img' => $faker->imageUrl($width = 480, $height = 480, 'cats'),
];
