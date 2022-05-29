<?php

declare(strict_types=1);

namespace Scratch\Domains\General\Contact\Adapters\Repositories;

use Jajo\JSONDB;
use Scratch\Domains\General\Contact\Adapters\Repositories\Contracts\ContactRepositoryContract;
use Scratch\Domains\General\Contact\Entities\Contact;
use Throwable;

final class ContactRepositoryLocal implements ContactRepositoryContract
{
    public function create(Contact $contact): ?string
    {
        $database = new JSONDB(__DIR__ . '/../../../../../../database/json');
        $id = uniqid('j', false);
        $contact->setId($id);
        try {
            $values = [
                'id' => $contact->getId(),
                'name' => $contact->getName(),
                'email' => $contact->getEmail(),
            ];
            $database->insert('contacts.json', $values);
            return $id;
        } catch (Throwable) {
            // dispatch error log
            return null;
        }
    }
}
