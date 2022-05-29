<?php

use Scratch\Http\Examples\HelloAction;
use Scratch\Http\HomeAction;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate App
$app = AppFactory::create();

// Add routes
$app->get('/', HomeAction::class);
$app->get('/hello/{name}', HelloAction::class);

$app->run();
