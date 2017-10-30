<?php
declare(strict_types = 1);

namespace Tests;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;
use UkLocation\Commands\GetUKLocationByTownsCommand;

class TestBootstrapFactory
{
    public static function create(string $commandString, array $parameters) : CommandTester
    {
        $application = new Application();
        $application->add(new GetUKLocationByTownsCommand());

        $command = $application->find($commandString);
        $commandTester = new CommandTester($command);
        $parameters['command'] = $command->getName();

        $commandTester->execute($parameters);

        return $commandTester;
    }
}