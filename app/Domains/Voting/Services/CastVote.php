<?php

declare(strict_types=1);

namespace App\Domains\Voting\Services;

use App\Domains\Voting\Adapters\Repository\Contract\BallotRepositoryContract;
use App\Domains\Voting\Services\Contract\CastVoteContract;

/**
 * Class CastVote
 *
 * @package App\Domains\Voting\Services
 */
final class CastVote implements CastVoteContract
{
    /**
     * @param BallotRepositoryContract $repository
     */
    public function __construct(private readonly BallotRepositoryContract $repository)
    {
    }

    /**
     * @param string $vote
     *
     * @return string
     */
    public function execute(string $vote): string
    {
        $ballot = $this->repository->computeVote($vote);
        return $ballot->getId();
    }
}
