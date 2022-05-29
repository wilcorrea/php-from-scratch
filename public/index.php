<?php

use DI\ContainerBuilder;
use Scratch\Domains\General\Contact\Adapters\Repositories\ContactRepositoryLocal;
use Scratch\Domains\General\Contact\Adapters\Repositories\Contracts\ContactRepositoryContract;
use Scratch\Domains\General\Contact\Services\Contracts\CreateContactContract;
use Scratch\Domains\General\Contact\Services\CreateContact;
use Scratch\Http\Examples\HelloAction;
use Scratch\Http\General\Contact\CreateContactAction;
use Scratch\Http\HomeAction;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$definitions = [
    CreateContactContract::class => DI\autowire(CreateContact::class),
    ContactRepositoryContract::class => DI\autowire(ContactRepositoryLocal::class),
];

// Create Container using PHP-DI
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions($definitions);
$container = $containerBuilder->build();

// Set container to create App with on AppFactory
AppFactory::setContainer($container);

// Instantiate App
$app = AppFactory::create();

// Parse JSON-encoded and XML-encoded bodies
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// Add routes
$app->get('/', HomeAction::class);
$app->get('/hello/{name}', HelloAction::class);

// HTTP ->
// [controller / action] ->
// [service / use case] ->
// repository <- entity -> database
$app->post('/general/contacts', CreateContactAction::class);

$app->run();
