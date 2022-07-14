<?php

declare(strict_types=1);

namespace App\Domains\Inspiration\Adapters\Http;

use App\Domains\Inspiration\Services\Contract\GetInspirationalQuoteContract;
use App\Shared\Adapters\Http\Action;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class InspireAction
 *
 * @package App\Domains\Inspiration\Adapters\Http
 */
final class InspireAction extends Action
{
    /**
     * @param GetInspirationalQuoteContract $service
     *
     * @return Response
     */
    public function handle(GetInspirationalQuoteContract $service): Response
    {
        return $this->success(['quote' => $service->execute()]);
    }
}
