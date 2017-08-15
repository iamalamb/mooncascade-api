<?php
return [
    'team'    => [
        'total' => env('TOTAL_TEAMS', 50),
    ],
    'athlete' => [
        'total' => env('TOTAL_ATHLETES', 500),
        'age'   => [
            'max' => env('MAX_ATHLETE_AGE', 75),
            'min' => env('MIN_ATHLETE_AGE', 18),
        ],
    ],
];
