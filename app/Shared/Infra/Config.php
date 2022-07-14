<?php

declare(strict_types=1);

namespace App\Shared\Infra;

use Exception;
use RuntimeException;

/**
 * Class Config
 *
 * @package App\Shared\Infra
 */
final class Config
{
    /**
     * @var Config
     */
    private static Config $instance;

    /**
     * @var array
     */
    private array $bag;

    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    private function __construct()
    {
        $this->bag = [
            'app' => require __DIR__ . '/../../../config/app.php',
            'database' => require __DIR__ . '/../../../config/database.php',
            'broker' => require __DIR__ . '/../../../config/broker.php',
        ];
    }

    /**
     * @param string $path
     * @param $default
     *
     * @return mixed
     */
    public function get(string $path, $default = null): mixed
    {
        $temporary = $this->bag;
        if (isset($temporary[$path])) {
            return $temporary[$path];
        }

        foreach (explode('.', $path) as $part) {
            if (!is_array($temporary) || !isset($temporary[$part])) {
                return $default;
            }

            $temporary = $temporary[$part];
        }

        return $temporary;
    }

    /**
     * Singletons should not be cloneable.
     */
    private function __clone()
    {
    }

    /**
     * Singletons should not be restorable from strings.
     *
     * @return mixed
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new RuntimeException('Cannot unserialize a singleton.');
    }

    /**
     * This is the static method that controls the access to the singleton
     * instance. On the first run, it creates a singleton object and places it
     * into the static field. On subsequent runs, it returns the client existing
     * object stored in the static field.
     *
     * This implementation lets you subclass the Singleton class while keeping
     * just one instance of each subclass around.
     */
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new Config();
        }

        return self::$instance;
    }
}
