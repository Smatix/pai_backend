<?php

namespace App\Tests\Reservation\Application\Command;

use App\Reservation\Application\Command\Accept\AcceptReservationCommand;
use App\Reservation\Application\Command\Accept\AcceptReservationHandler;
use App\Reservation\Domain\Factory\ReservationFactory;
use App\Reservation\Domain\Reservation;
use App\Reservation\Domain\ReservationStoreRepositoryInterface;
use App\Reservation\Infrastructure\InMemoryReservationStoreRepository;
use App\Shared\Domain\Model\ParkingSpaceType;
use PHPUnit\Framework\TestCase;

class AcceptReservationHandlerTest extends TestCase
{
    /**
     * @var ReservationStoreRepositoryInterface
     */
    private $repository;

    protected function setUp()
    {
        parent::setUp();
        $this->repository = new InMemoryReservationStoreRepository();
        $reservation = $this->createReservation();
        $this->repository->save($reservation);

    }

    public function createReservation()
    {
        $date = new \DateTime('tomorrow');
        $reservation = ReservationFactory::create(
            '594f483a-20f0-11ea-978f-2e728ce88125',
            $date->format('Y-m-d'),
            new ParkingSpaceType('car'),
            '594f483a-20f0-11ea-978f-2e728ce88125',
            '594f483a-20f0-11ea-978f-2e728ce88125');
        return $reservation;
    }

    public function testAcceptReservation()
    {
        $command = new AcceptReservationCommand('594f483a-20f0-11ea-978f-2e728ce88125');

        $handler = new AcceptReservationHandler($this->repository);
        $handler($command);

        /** @var Reservation $reservation */
        $reservation = $this->repository->getById('594f483a-20f0-11ea-978f-2e728ce88125');
        $this->assertEquals(Reservation::STATUS_ACTIVE, $reservation->getStatus());
    }
}