<?php

use App\Shared\Infra\Config;

if (!function_exists('config')) {
    /**
     * @param string $path
     * @param null $default
     *
     * @return mixed
     */
    function config(string $path, $default = null): mixed
    {
        return Config::getInstance()->get($path, $default);
    }
}

if (!function_exists('env')) {
    /**
     * @param string $name
     * @param null $default
     *
     * @return mixed
     */
    function env(string $name, $default = null): mixed
    {
        return $_ENV[$name] ?? $default;
    }
}
