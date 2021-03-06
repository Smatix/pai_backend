<?php

namespace App\Parking\Domain\Model;


use App\Parking\Domain\Parking;

class OpeningHours
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var Parking
     */
    private $parking;

    /**
     * @var integer
     */
    private $weekDay;

    /**
     * @var \DateTime
     */
    private $open;

    /**
     * @var \DateTime
     */
    private $close;

    /**
     * OpeningHours constructor.
     * @param int $weekDay
     * @param string $open
     * @param string $close
     * @throws
     */
    public function __construct(int $weekDay, string $open, string $close)
    {
        $this->weekDay = $weekDay;
        $this->open = new \DateTime('2000-01-01 '.$open.':00');
        $this->close = new \DateTime('2000-01-01 '.$close.':00');
    }

    /**
     * @param Parking $parking
     */
    public function setParking(Parking $parking): void
    {
        $this->parking = $parking;
    }

    /**
     * @return string
     */
    public function getOpenHour(): string
    {
        return $this->open->format('H:i');
    }

    /**
     * @return string
     */
    public function getCloseHour(): string
    {
        return $this->close->format('H:i');
    }
}