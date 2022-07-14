<?php

declare(strict_types=1);

namespace App\Http\Info;

use App\Shared\Adapters\Http\Action;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class HealtcheckAction
 *
 * @package App\Http\Info
 */
class HealtcheckAction extends Action
{
    /**
     * @return Response
     */
    public function handle(): Response
    {
        return $this->success($_ENV);
    }
}
