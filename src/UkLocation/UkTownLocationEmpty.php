<?php
declare(strict_types=1);

namespace UkLocation;

class UkTownLocationEmpty
{
    /** @var string */
    private $town = '';

    public function __construct($town)
    {
        $this->town = $town;
    }

    /**
     * @return string
     */
    public function getTown() : string
    {
        return $this->town;
    }
}