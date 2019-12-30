<?php
/**
 * @var $faker \Faker\Generator
 * @var $index 0..10
 */
return [
    'owner_id' => $faker->numberBetween($min=1, $max=5),
    'title' => $faker->sentence,
    'body' => $faker->text,
    'rating' => $faker->randomDigit,
    'timestamp' => $faker->iso8601($max='now'),
];