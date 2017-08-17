<?php
return [
    'team'      => [
        'total' => env('TOTAL_TEAMS', 50),
    ],
    'athlete'   => [
        'total' => env('TOTAL_ATHLETES', 500),
        'age'   => [
            'max' => env('MAX_ATHLETE_AGE', 75),
            'min' => env('MIN_ATHLETE_AGE', 18),
        ],
    ],
    'execution' => [
        'delay_race_start'                      => env('DELAY_RACE_START', true),
        'delay_race_start_time'                 => env('DELAY_RACE_START_TIME', 60),
        'delay_athlete_execution_min_threshold' => env('DELAY_ATHLETE_EXECUTION_MIN_THRESHOLD', 5),
        'delay_athlete_execution_max_threshold' => env('DELAY_ATHLETE_EXECUTION_MAX_THRESHOLD', 6),
    ],
];
