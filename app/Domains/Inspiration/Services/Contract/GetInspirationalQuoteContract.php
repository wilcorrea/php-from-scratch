<?php

declare(strict_types=1);

namespace App\Domains\Inspiration\Services\Contract;


/**
 * Class GetInspirationalQuoteContract
 *
 * @package App\Domains\Inspiration\Services\Contract
 */
interface GetInspirationalQuoteContract
{
    /**
     * @return string
     */
    public function execute(): string;
}
