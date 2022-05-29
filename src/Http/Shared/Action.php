<?php

declare(strict_types=1);

namespace Scratch\Http\Shared;

use Php\JSON;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Action
{
    protected Request $request;
    protected Response $response;

    abstract public function handle(array $args, array $body): Response;

    final public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $body = $request->getParsedBody();
        return $this->handle($args, $body);
    }

    protected function success(object|array $data): Response
    {
        return $this->answer(200, 'success', $data);
    }

    protected function fail(object|array $data): Response
    {
        return $this->answer(400, 'fail', $data);
    }

    protected function answer(int $code, string $status, object|array $data): Response
    {
        $answer = [
            'status' => $status,
            'data' => $data,
        ];
        $this->response->getBody()->write(JSON::encode($answer));
        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}
