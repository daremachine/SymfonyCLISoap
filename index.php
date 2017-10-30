<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use UkLocation\Commands\GetUKLocationByTownsCommand;

$app = new Application();
$app->add(new GetUKLocationByTownsCommand());
$app->run();