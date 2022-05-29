<?php

declare(strict_types=1);

namespace Scratch\Http\General\Contact;

use Psr\Http\Message\ResponseInterface as Response;
use Scratch\Domains\General\Contact\Services\Contracts\CreateContactContract;
use Scratch\Http\Shared\Action;

final class CreateContactAction extends Action
{
    private CreateContactContract $service;

    public function __construct(CreateContactContract $service)
    {
        $this->service = $service;
    }

    public function handle(array $args, array $body): Response
    {
        $created = $this->service->execute($body);
        if ($created) {
            return $this->success($created);
        }
        return $this->fail($body);
    }
}
