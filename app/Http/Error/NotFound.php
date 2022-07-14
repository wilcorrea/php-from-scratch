<?php

declare(strict_types=1);

namespace App\Http\Error;

use App\Shared\Adapters\Http\Action;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface as Container;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class NotFound
 *
 * @package App\Http\Error
 */
class NotFound extends Action
{
    /**
     * @param Request $request
     * @param Container $container
     * @param string $path
     *
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    final public function handle(Request $request, Container $container, string $path): Response
    {
        $data = ['path' => $path];
        $meta = [
            'query' => $request->getQueryParams(),
            'settings' => $container->get('settings'),
        ];
        return $this->fail($data, $meta);
    }
}
