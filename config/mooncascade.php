<?php
return [
    'athlete' => [
        'total' => env('TOTAL_ATHLETES', 500),
        'age'   => [
            'max' => env('MAX_ATHLETE_AGE', 75),
            'min' => env('MIN_ATHLETE_AGE', 18),
        ],
    ],
];
