#!/usr/bin/env php
<?php declare(strict_types = 1);

require __DIR__.'/../../vendor/autoload.php';

use Picamator\TransferObject\Command\GeneratorCommand;
use Symfony\Component\Console\Application;

$application = new Application('echo', '1.0.0');
$command = new GeneratorCommand();

$application->add($command);

$application->setDefaultCommand($command->getName(), true);
$application->run();
