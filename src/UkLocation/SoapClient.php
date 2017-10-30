<?php
declare(strict_types=1);

namespace UkLocation;

use UkLocation\Exceptions\BadCountParametersException;
use UkLocation\Exceptions\WsdlNotLoadException;

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
    public function GetUkLocationByTown(array $towns) : UkTownLocationResponse
    {
        // check correct parameters count
        if(count($towns) < 2 || count($towns) > 3) throw new BadCountParametersException("Please input minimum two and maximum three towns");

        $searchResult = [];
        $emptyResult = [];

        foreach($towns as $town) {
            try {
                $soapClient = new \SoapClient($this->wsdl);
                $response = $soapClient->GetUKLocationByTown(['Town' => $town]);

                $xmlResult = simplexml_load_string($response->GetUKLocationByTownResult);

                if(empty($xmlResult)) {
                    $emptyResult[] = new UkTownLocationEmpty($town);
                }
                foreach ($xmlResult as $el) {
                    $searchResult[] = new UkTownLocation((string) $el->Town, (string) $el->County, (string) $el->PostCode);
                }
            } catch (\SoapFault $sf) {
                if ($sf->faultcode == 'WSDL') {
                    throw new WsdlNotLoadException("Wsdl couldn't be loaded due to bad WSDL endpoint path or endpoint may be offline.");
                }

                throw new \Exception($sf->getMessage());
            }
        }

        return new UkTownLocationResponse($searchResult, $emptyResult);
    }
}