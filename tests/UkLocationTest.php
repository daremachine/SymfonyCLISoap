<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

require_once  './vendor/autoload.php';
require_once  './tests/TestBootstrapFactory.php';

class UkLocationTest extends TestCase
{
    public function testGetUkLocationByTownsCommand()
    {
        $tester = \Tests\TestBootstrapFactory::create("UkLocation:GetUKLocationByTowns", [
            'Towns' => ['formby', 'a']
        ]);

        $result = $tester->getDisplay();

        $this->assertEquals(is_string($result), true);
    }
}