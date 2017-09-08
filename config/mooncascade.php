<?php
return [
    'total_teams'                           => env('TOTAL_TEAMS', 50),
    'total_athletes'                        => env('TOTAL_ATHLETES', 500),
    'max_athlete_age'                       => env('MAX_ATHLETE_AGE', 75),
    'min_athlete_age'                       => env('MIN_ATHLETE_AGE', 75),
    'delay_race_start'                      => env('DELAY_RACE_START', true),
    'delay_race_start_time'                 => env('DELAY_RACE_START_TIME', 60),
    'delay_athlete_execution_min_threshold' => env('DELAY_ATHLETE_EXECUTION_MIN_THRESHOLD', 5),
    'delay_athlete_execution_max_threshold' => env('DELAY_ATHLETE_EXECUTION_MAX_THRESHOLD', 6),
    'batch_athlete_retrieval_min_threshold' => env('BATCH_ATHELETE_RETRIEVAL_MIN_THRESHOLD', 1),
    'batch_athlete_retrieval_max_threshold' => env('BATCH_ATHELETE_RETRIEVAL_MAX_THRESHOLD', 10),
    'available_strategies'                  => ['overtake', 'sequential', 'tie'],
    'gate_strategies'                       => ['sequential', 'tie'],
];
