<?php

declare(strict_types=1);

namespace App\Shared\Infra;

use Exception;

/**
 * Class HttpClient
 *
 * @package App\Shared\Infra
 */
trait HttpClient
{
    /**
     * @param bool|string $output
     *
     * @return mixed
     */
    abstract protected function handler(bool|string $output): mixed;

    /**
     * @param string $url
     *
     * @return mixed
     * @throws Exception
     */
    protected function request(string $url): mixed
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $this->handler($output);
    }
}
