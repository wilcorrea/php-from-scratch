<?php

declare(strict_types=1);

namespace App\Domains\Inspiration\Entities;

use App\Shared\Entities\Entity;

/**
 * Class Quote
 *
 * @package App\Domains\Inspiration\Entities
 */
class Quote extends Entity
{
    /**
     * @var string
     */
    protected string $sentence;

    /**
     * @var string
     */
    protected string $author;

    /**
     * @return string
     */
    public function getSentence(): string
    {
        return $this->sentence;
    }

    /**
     * @param string $sentence
     */
    protected function setSentence(string $sentence): void
    {
        $this->sentence = $sentence;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    protected function setAuthor(string $author): void
    {
        $this->author = $author;
    }
}
