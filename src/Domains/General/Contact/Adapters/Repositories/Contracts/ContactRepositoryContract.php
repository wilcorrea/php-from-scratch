<?php

declare(strict_types=1);

namespace Scratch\Domains\General\Contact\Adapters\Repositories\Contracts;

use Scratch\Domains\General\Contact\Entities\Contact;

interface ContactRepositoryContract
{
    public function create(Contact $contact): ?string;
}
