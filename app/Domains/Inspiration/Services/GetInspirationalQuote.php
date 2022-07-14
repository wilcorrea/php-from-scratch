<?php

declare(strict_types=1);

namespace App\Domains\Inspiration\Services;

use App\Domains\Inspiration\Adapters\Contract\InspireRepositoryContract;
use App\Domains\Inspiration\Services\Contract\GetInspirationalQuoteContract;

/**
 * Class GetInspirationalQuote
 *
 * @package App\Domains\Inspiration\Services
 */
final class GetInspirationalQuote implements GetInspirationalQuoteContract
{
    /**
     * @param InspireRepositoryContract $repository
     */
    public function __construct(private readonly InspireRepositoryContract $repository)
    {
    }

    /**
     * @return string
     */
    public function execute(): string
    {
        $quote = $this->repository->getInspirationalQuote();
        return "{$quote->getSentence()} - {$quote->getAuthor()}";
    }
}
