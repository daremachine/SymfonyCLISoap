<?php
declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;
use UkLocation\Commands\GetUKLocationByTownsCommand;

require_once  './vendor/autoload.php';

class UkLocationTest extends TestCase
{
    public function testGetUkLocationByTownsCommand()
    {
        $application = new Application();
        $application->add(new GetUKLocationByTownsCommand());

        $command = $application->find('UkLocation:GetUKLocationByTowns');
        $commandTester = new CommandTester($command);
        $parameters = [
                'command' => $command->getName(),
                'Towns' => ['formby', 'londox']
            ];

        $commandTester->execute($parameters);

        $result = $commandTester->getDisplay();

        $this->assertEquals(is_string($result), true);
    }
}