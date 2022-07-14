<?php

declare(strict_types=1);

namespace App\Domains\Voting\Adapters\Repository;

use App\Domains\Voting\Adapters\Repository\Contract\BallotRepositoryContract;
use App\Domains\Voting\Entities\Ballot;
use DateTime;
use Exception;
use Php\JSON;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class BallotRepositoryRabbitMQ
 *
 * @package App\Domains\Voting\Adapters\Repository
 */
class BallotRepositoryRabbitMQ implements BallotRepositoryContract
{
    /**
     * @var AMQPChannel|null
     */
    private ?AMQPChannel $channel;

    /**
     * @param string $vote
     *
     * @return Ballot
     * @throws Exception
     */
    public function computeVote(string $vote): Ballot
    {
        $ballot = Ballot::instance([
            'vote' => $vote,
            'createdAt' => new DateTime(),
        ]);
        $this->create($ballot->toArray());
        return $ballot;
    }

    /**
     * @return AMQPChannel
     */
    protected function channel(): AMQPChannel
    {
        if (!isset($this->channel)) {
            $host = config('broker.drivers.rabbitmq.host', 'bbb-queue');
            $port = config('broker.drivers.rabbitmq.port', 5672);
            $user = config('broker.drivers.rabbitmq.user', 'guest');
            $password = config('broker.drivers.rabbitmq.password', 'guest');

            $connection = new AMQPStreamConnection($host, $port, $user, $password);
            $this->channel = $connection->channel();
        }
        return $this->channel;
    }

    /**
     * @param array $data
     *
     * @return void
     * @throws Exception
     */
    protected function create(array $data): void
    {
        $message = new AMQPMessage(JSON::encode($data));
        $exchange = config('broker.drivers.rabbitmq.exchange', 'voto-solicitado');
        $routing_key = config('broker.drivers.rabbitmq.routing_key', 'voto');
        $this->channel()->basic_publish($message, $exchange, $routing_key);
    }
}
