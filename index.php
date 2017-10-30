<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use UkLocation\Commands\GetUKLocationByTownCommand;

$app = new Application();
$app->add(new GetUKLocationByTownCommand());
$app->run();