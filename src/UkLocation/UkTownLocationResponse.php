<?php
declare(strict_types=1);

namespace UkLocation;

class UkTownLocationResponse
{
    /** @var array */
    private $townLocations = [];

    /** @var array */
    private $notices = [];

    public function __construct(array $townLocations, array $notices)
    {
        $this->townLocations = $townLocations;
        $this->notices = $notices;
    }

    /**
     * @return array
     */
    public function getNotices() : array
    {
        return $this->notices;
    }

    /**
     * @return array
     */
    public function getTownLocations() : array
    {
        return $this->townLocations;
    }
}