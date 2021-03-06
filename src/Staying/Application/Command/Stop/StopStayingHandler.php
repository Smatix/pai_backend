<?php

namespace App\Staying\Application\Command\Stop;

use App\Staying\Domain\Staying;
use App\Staying\Domain\StayingStoreRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class StopStayingHandler implements MessageHandlerInterface
{
    /**
     * @var StayingStoreRepositoryInterface
     */
    private $repository;

    /**
     * StopStayingHandler constructor.
     * @param StayingStoreRepositoryInterface $repository
     */
    public function __construct(StayingStoreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(StopStayingCommand $command)
    {
        /** @var Staying $staying */
        $staying = $this->repository->getById($command->getId());

        $staying->stopCountingTime();
        $this->repository->save($staying);
    }
}