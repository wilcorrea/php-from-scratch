<?php

declare(strict_types=1);

namespace App\Http;

use DI\ContainerBuilder;
use Exception;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Symfony\Component\Dotenv\Dotenv;
use Throwable;

/**
 * Class Kernel
 *
 * @package App\Http
 */
final class Kernel extends AppFactory
{
    /**
     * @return App
     */
    public static function bootstrap(): App
    {
        try {
            self::setContainer(self::container());
        } catch (Throwable) {
        }
        $app = self::create();
        $app->addBodyParsingMiddleware();
        $app->addRoutingMiddleware();
        $app->addErrorMiddleware(true, true, true);
        $http = require __DIR__ . '/../../routes/http.php';
        $http($app);

        $dotenv = new Dotenv('APP_ENV');
        $dotenv->loadEnv(__DIR__ . '/../../.env');
        return $app;
    }

    /**
     * @return ContainerInterface
     * @throws Exception
     */
    private static function container(): ContainerInterface
    {
        $di = require __DIR__ . '/../../config/di.php';
        $definitions = $di['definitions'] ?? [];
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions($definitions);
        $container = $containerBuilder->build();
        $container->set('settings', []);
        return $container;
    }
}
