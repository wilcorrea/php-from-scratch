<?php

declare(strict_types=1);

namespace Scratch\Domains\General\Contact\Services\Contracts;

interface CreateContactContract
{
    public function execute(array $values): ?array;
}
