<?php

declare(strict_types=1);

namespace App\Domains\Voting\Adapters\Http;

use App\Domains\Voting\Services\Contract\CastVoteContract;
use App\Shared\Adapters\Http\Action;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class BallotAction
 *
 * @package App\Domains\Voting\Adapters\Http
 */
class VoteLocalAction extends Action
{
    /**
     * @param Request $request
     * @param CastVoteContract $service
     *
     * @return Response
     */
    public function handle(Request $request, CastVoteContract $service): Response
    {
        $body = $request->getParsedBody();
        $vote = $body['vote'] ?? null;
        if (!is_string($vote)) {
            $vote = '';
        }
        $data = ['code' => $service->execute($vote)];
        return $this->success($data);
    }
}
