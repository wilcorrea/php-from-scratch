<?php

declare(strict_types=1);

namespace Scratch\Http;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeAction
{
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $response->getBody()->write('Hello, world!');
        return $response;
    }
}
