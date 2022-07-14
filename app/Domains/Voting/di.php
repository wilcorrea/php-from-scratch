<?php

//use App\Domains\Voting\Adapters\Repository\BallotRepositoryLocal;
use App\Domains\Voting\Adapters\Repository\BallotRepositoryRabbitMQ;
use App\Domains\Voting\Adapters\Repository\Contract\BallotRepositoryContract;
use App\Domains\Voting\Services\CastVote;
use App\Domains\Voting\Services\Contract\CastVoteContract;

return [
    CastVoteContract::class => DI\autowire(CastVote::class),
//    BallotRepositoryContract::class => DI\autowire(BallotRepositoryLocal::class),
    BallotRepositoryContract::class => DI\autowire(BallotRepositoryRabbitMQ::class),
];
