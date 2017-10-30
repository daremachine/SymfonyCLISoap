<?php
declare(strict_types=1);

namespace UkLocation;

class SoapClient
{
    /** Wsdl remote url */
    const WSDL_REMOTE = 'http://www.webservicex.net/uklocation.asmx?WSDL';

    /** @var null|string */
    protected $wsdl = null;

    /**
     * SoapClient constructor.
     * @param null $wsdl
     */
    public function __construct($wsdl = null)
    {
        $this->wsdl = $wsdl ?? self::WSDL_REMOTE;
    }

    /**
     * Get Uk postcodes by town name
     * @param array $towns
     * @param string $wsdl
     * @return UkTownLocationResponse
     * @throws \Exception
     */
    public function GetUkLocationByTown(array $towns : array
    {
        $soapClient = new \SoapClient($this->wsdl);
        $response = $soapClient->GetUKLocationByTown(['Town' => 'formby']);

        $xmlResult = simplexml_load_string($response->GetUKLocationByTownResult);

        $result = [];

        foreach($xmlResult as $row)
        {
            $result[] = $row->PostCode;
        }

        return $result;
    }
}