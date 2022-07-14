<?php

declare(strict_types=1);

namespace App\Shared\Entities\Contract;

use App\Shared\Entities\Entity;
use JsonException;

/**
 * Class EntityContract
 *
 * @package App\Shared\Entities\Contract
 */
interface EntityContract
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @param array $data
     *
     * @return Entity
     */
    public function fill(array $data): self;

    /**
     * Output an array based on entity properties
     *
     * @param bool $useSnakeCase
     *
     * @return array
     * @throws JsonException
     */
    public function toArray(bool $useSnakeCase = false): array;
}
