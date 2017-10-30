<?php
declare(strict_types=1);

namespace UkLocation;

class UkTownLocation
{
    /** @var string */
    private $town = '';

    /** @var string */
    private $postCode = '';

    /** @var string */
    private $county = '';

    public function __construct(string $town, string $county, string $postCode)
    {
        $this->town = $town;
        $this->postCode = $postCode;
        $this->county = $county;
    }

    /**
     * @return string
     */
    public function getTown() : string
    {
        return $this->town;
    }

    /**
     * @return string
     */
    public function getPostCode() : string
    {
        return $this->postCode;
    }

    /**
     * @return string
     */
    public function getCounty() : string
    {
        return $this->county;
    }
}