<?php

declare(strict_types=1);

namespace Scratch\Http\Examples;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HelloAction
{
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    }
}
