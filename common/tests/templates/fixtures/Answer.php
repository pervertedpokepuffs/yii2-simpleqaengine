<?php

/**
 * @var $faker \Faker\Generator
 * @var $index 0..30
 */
return [
    'owner_id' => $faker->numberBetween($min = 1, $max = 5),
    'question_id' => $faker->numberBetween($min = 1, $max = 10),
    'body' => $faker->text,
    'rating' => $faker->randomDigit,
    'timestamp' => $faker->iso8601($max = 'now'),
];
