<?php

return [
    'DATE_TIME_FORMAT' => 'Y-m-d H:i:s',
    'DATE_TIME_FORMAT_SLACK' => 'h:i A, M d, Y',
    'DEFAULT' => [
        'LIMIT' => 10,
        'OFFSET' => 0,
        'SORT' => 'desc',
        'PAGINATION' => 5
    ],
    'ROUND' => 2,
    'WEEK_MINUTES' => 7 * 24 * 60,
    'DAY_MINUTES' => 24 * 60,
    'NEXT_FIBONACCI_NUM' => (1 + sqrt(5)) / 2,
    'NIGHT_SCHEDULER_TIME' => '23:30',
    'FOUNDER' => [
        'NAME' => 'Sahil Gupta',
        'EMAIL' => 'er.sahilgupta1@gmail.com',
        'WEBSITE' => 'https://sahilgupta28.herokuapp.com',
        'TWITTER' => 'https://twitter.com/_sahil_gupta',
        'LINKED_IN' => 'https://www.linkedin.com/in/sahilgupta28/',
        'GITHUB' => 'https://github.com/sahilgupta28',
        'STACK_OVERFLOW' => 'https://stackoverflow.com/users/9606475/sahil-gupta',
        'BLOG' => 'https://sahilgupta1.blogspot.com/'
    ],
    'SLACK_REG' => '~\b(https?://)hooks\.slack\.com/services/(\S+\b)/(\S+\b)/(\S+\b)~',
    'SLACK_SLUG' => 'https://hooks.slack.com/services/*****/*****/*****',
    'DELETE_LOG_DAYS' => 15,
    'ROLE' => [
        'ADMIN' => 1,
        'USER' => 2
    ]
];
