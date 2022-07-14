<?php

declare(strict_types=1);

namespace App\Domains\Voting\Services\Contract;

/**
 * Class CastVoteContract
 *
 * @package App\Domains\Voting\Services\Contract
 */
interface CastVoteContract
{
    /**
     * @param string $vote
     *
     * @return string
     */
    public function execute(string $vote): string;
}
