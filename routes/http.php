<?php

use App\Http\Info\HealtcheckAction;
use Slim\App;
use App\Domains\Inspiration\Adapters\Http\InspireAction;
use App\Domains\Voting\Adapters\Http\VoteLocalAction;
use App\Http\Error\NotFound;

/**
 * @param App $app
 *
 * @return void
 */
return static function (App $app): void {
    $app->get('/healthcheck', HealtcheckAction::class);

    $app->get('/inspire', InspireAction::class);

    $app->post('/vote', VoteLocalAction::class);

    $app->any('/{path:.*}', NotFound::class);
};
