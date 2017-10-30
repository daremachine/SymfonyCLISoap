<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use UkLocation\SoapClient;

require_once  './vendor/autoload.php';
require_once  './tests/TestBootstrapFactory.php';

class UkLocationTest extends TestCase
{
    const TEST_WSDL_REMOTE = 'http://www.webservicex.net/uklocation.asmx?WSDL';
    const TEST_WSDL_REMOTE_FAIL = 'http://www.webservicex.net/invalid.tld?WSDL';

    public function testGetUkLocationByTownsCommand()
    {
        $tester = \Tests\TestBootstrapFactory::create("UkLocation:GetUKLocationByTowns", [
            'Towns' => ['formby', 'failingName0']
        ]);

        $result = $tester->getDisplay();

        $this->assertEquals(is_string($result), true);
    }

    public function testGetUkLocationByTownVerifyData()
    {
        $towns = ['formby', 'b'];
        $soapClient = new SoapClient('http://www.webservicex.net/uklocation.asmx?WSDL');
        $data = $soapClient->GetUkLocationByTown($towns);

        $this->assertEquals(count($data->getTownLocations()) > 0, true);
        $this->assertNotEmpty($data->getTownLocations()[0]->getTown());
        $this->assertNotEmpty($data->getTownLocations()[0]->getPostCode());
    }
}