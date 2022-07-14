<?php

declare(strict_types=1);

namespace App\Domains\Inspiration\Adapters\Repository;

use App\Domains\Inspiration\Adapters\Contract\InspireRepositoryContract;
use App\Domains\Inspiration\Entities\Quote;
use App\Shared\Infra\HttpClient;
use Exception;
use JsonException;

/**
 * Class InspireRepositoryCURL
 *
 * @package App\Domains\Inspiration\Adapters\Repository
 */
final class InspireRepositoryCURL implements InspireRepositoryContract
{
    use HttpClient;

    /**
     * @return Quote
     * @throws Exception
     */
    public function getInspirationalQuote(): Quote
    {
        $data = $this->request('https://zenquotes.io/api/random');
        return Quote::instance($data);
    }

    /**
     * @param bool|string $output
     *
     * @return mixed
     * @throws Exception
     */
    private function handler(bool|string $output): mixed
    {
        if (!$output) {
            return [
                'sentence' => 'No quote found',
                'author' => ''
            ];
        }
        try {
            $output = json_decode($output, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return [
                'sentence' => 'Can not get a quote now',
                'author' => ''
            ];
        }
        if (count($output) === 0) {
            return [
                'sentence' => 'Can not get a quote now',
                'author' => ''
            ];
        }
        $sentence = $output[0]['q'] ?? '';
        $author = $output[0]['a'] ?? '';
        return [
            'sentence' => $sentence,
            'author' => $author
        ];
    }
}
