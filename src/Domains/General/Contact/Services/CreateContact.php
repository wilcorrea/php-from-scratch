<?php

declare(strict_types=1);

namespace Scratch\Domains\General\Contact\Services;

use Scratch\Domains\General\Contact\Adapters\Repositories\Contracts\ContactRepositoryContract;
use Scratch\Domains\General\Contact\Entities\Contact;
use Scratch\Domains\General\Contact\Services\Contracts\CreateContactContract;

final class CreateContact implements CreateContactContract
{
    public function __construct(
        protected readonly ContactRepositoryContract $repository
    ) {
    }

    public function execute(array $values): ?array
    {
        $name = $values['name'] ?? '';
        $email = $values['email'] ?? '';
        $contact = new Contact(
            name: $name,
            email: $email
        );
        $id = $this->repository->create($contact);
        if (!$id) {
            return null;
        }
        return [
            'id' => $id,
            'name' => $name,
            'email' => $email,
        ];
    }
}
