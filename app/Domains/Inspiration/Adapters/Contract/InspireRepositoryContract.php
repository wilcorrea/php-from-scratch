<?php

declare(strict_types=1);

namespace App\Domains\Inspiration\Adapters\Contract;

use App\Domains\Inspiration\Entities\Quote;

/**
 * Class InspireRepositoryContract
 *
 * @package App\Domains\Inspiration\Adapters\Repository
 */
interface InspireRepositoryContract
{
    /**
     * @return Quote
     */
    public function getInspirationalQuote(): Quote;
}
