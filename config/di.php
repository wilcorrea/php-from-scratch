<?php

$inspiration = require __DIR__ . '/../app/Domains/Inspiration/di.php';
$voting = require __DIR__ . '/../app/Domains/Voting/di.php';

return [
    'definitions' => [
        ...$inspiration,
        ...$voting,
    ],
];
