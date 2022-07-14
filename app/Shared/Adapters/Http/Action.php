<?php

declare(strict_types=1);

namespace App\Shared\Adapters\Http;

use Php\JSON;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;

/**
 * Class Action
 *
 * @package App\Shared\Adapters\Http
 */
abstract class Action
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * @var Response
     */
    private Response $response;

    /**
     * @param ContainerInterface $container
     */
    final public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $status
     * @param array $data
     * @param array $meta
     *
     * @return string
     */
    protected function contentFormat(string $status, array $data, array $meta): string
    {
        return JSON::encode([
            'status' => $status,
            'data' => $data,
            'meta' => $meta,
        ]);
    }

    /**
     * @return string
     */
    protected function contentType(): string
    {
        return 'application/json';
    }

    /**
     * @param array $data
     * @param array $meta
     * @param int $code
     *
     * @return Response
     */
    final protected function success(array $data, array $meta = [], int $code = 200): Response
    {
        return $this->answer('success', $data, $meta)->withStatus($code);
    }

    /**
     * @param array $data
     * @param array $meta
     * @param int $code
     *
     * @return Response
     */
    final protected function fail(array $data, array $meta = [], int $code = 400): Response
    {
        return $this->answer('fail', $data, $meta)->withStatus($code);
    }

    /**
     * @param array $data
     * @param array $meta
     * @param int $code
     *
     * @return Response
     */
    final protected function error(array $data, array $meta = [], int $code = 500): Response
    {
        return $this->answer('error', $data, $meta)->withStatus($code);
    }

    /**
     * @param string $status
     * @param array $data
     * @param array $meta
     *
     * @return Response
     */
    private function answer(string $status, array $data, array $meta = []): Response
    {
        $output = $this->contentFormat($status, $data, $meta);
        $this->response->getBody()->write($output);
        return clone $this->response->withHeader('Content-Type', $this->contentType());
    }

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return mixed
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    final public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->response = $response;

        if (!method_exists($this, 'handle')) {
            return $this->error(data: ['method' => 'not-implemented'], code: 501);
        }

        $parameters = [
            ...$args,
            'request' => clone $request,
            'container' => clone $this->container,
        ];
        try {
            return $this->container->call([$this, 'handle'], $parameters);
        } catch (Throwable $error) {
            $data = [
                'message' => $error->getMessage(),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ];
            return $this->fail(data: $data, code: 405);
        }
    }
}
