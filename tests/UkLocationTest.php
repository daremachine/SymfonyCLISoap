<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use UkLocation\Exceptions\BadCountParametersException;
use UkLocation\SoapClient;

require_once  './vendor/autoload.php';
require_once  './tests/TestBootstrapFactory.php';

class UkLocationTest extends TestCase
{
    const TEST_WSDL_REMOTE = 'http://www.webservicex.net/uklocation.asmx?WSDL';
    const TEST_WSDL_REMOTE_FAIL = 'http://www.webservicex.net/invalid.tld?WSDL';

    public function testGetUkLocationByTownsCommand()
    {
        // formby - is town name, a - should generate empty result
        $tester = \Tests\TestBootstrapFactory::create("UkLocation:GetUKLocationByTowns", [
            'Towns' => ['formby', 'failingName0']
        ]);

        $result = $tester->getDisplay();

        $this->assertEquals(is_string($result), true);
        $this->assertNotEmpty($result);
        $this->assertContains('PostCode:', $result);
        $this->assertContains('No results found', $result);
    }

    public function testGetUkLocationByTownVerifyData()
    {
        $towns = ['formby', 'failingName0'];
        $soapClient = new SoapClient(self::TEST_WSDL_REMOTE);
        $data = $soapClient->GetUkLocationByTown($towns);

        $this->assertEquals(count($data->getTownLocations()) > 0, true);
        $this->assertNotEmpty($data->getTownLocations()[0]->getTown());
        $this->assertNotEmpty($data->getTownLocations()[0]->getPostCode());
    }

    public function testGetLocationWithOneTownShouldFail()
    {
        $this->expectException(BadCountParametersException::class);

        $towns = ['failingName0'];
        $soapClient = new SoapClient(self::TEST_WSDL_REMOTE);
        $data = $soapClient->GetUkLocationByTown($towns);
    }

    public function testGetLocationWithMoreThreeTownShouldFail()
    {
        $this->expectException(BadCountParametersException::class);

        $towns = ['failingName0', 'failingName0', 'failingName0', 'failingName0'];
        $soapClient = new SoapClient(self::TEST_WSDL_REMOTE);
        $data = $soapClient->GetUkLocationByTown($towns);
    }

    public function testSoapClientConnectionDownShouldFail()
    {
        $this->expectException(\Exception::class);

        $towns = ['failingName0', 'failingName0', 'failingName0'];
        $soapClient = new SoapClient(self::TEST_WSDL_REMOTE_FAIL);
        $data = $soapClient->GetUkLocationByTown($towns);
    }
}