<?php

declare(strict_types=1);

namespace App\Domains\Voting\Entities;

use App\Shared\Entities\Entity;
use DateTimeInterface;

/**
 * Class Ballot
 *
 * @package App\Domains\Voting\Entities
 */
class Ballot extends Entity
{
    /**
     * @var string
     */
    protected string $vote;

    /**
     * @var DateTimeInterface
     */
    protected DateTimeInterface $createdAt;

    /**
     * @return string
     */
    public function getVote(): string
    {
        return $this->vote;
    }

    /**
     * @param string $vote
     */
    protected function setVote(string $vote): void
    {
        $this->vote = $vote;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     */
    protected function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
