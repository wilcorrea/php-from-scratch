<?php

declare(strict_types=1);

namespace App\Domains\Voting\Adapters\Repository\Contract;


use App\Domains\Voting\Entities\Ballot;

/**
 * Class BallotRepositoryContract
 *
 * @package App\Domains\Voting\Adapters\Repository\Contract
 */
interface BallotRepositoryContract
{
    /**
     * @param string $vote
     *
     * @return Ballot
     */
    public function computeVote(string $vote): Ballot;
}
