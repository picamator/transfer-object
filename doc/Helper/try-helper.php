<?php declare(strict_types=1);

use Picamator\TransferObject\Command\GeneratorCommand;
use Picamator\TransferObject\Helper\HelperFacade;
use Picamator\TransferObject\Transfer\Generated\HelperContentTransfer;
use Picamator\TransferObject\Transfer\Generated\HelperTransfer;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

require_once __DIR__. '/../../vendor/autoload.php';


echo <<<'STORY'
======================================
            Product
               &
            as Array
======================================

STORY;
$productData = [
    'sku' => 'T-123',
    'name' => 'Tomato',
    'price' => 12.99,
    'currency' => 'EUR',
    'stock' => 100,
    'isDiscounted' => false,
    'deliveryOptions' => [
        ['name' => 'express'],
        ['name' => 'standard']
    ],
    'details' => [
        'description' => 'Tomato from fields.',
        'isRegional' => true,
    ],
    'stores' => ['DE', 'AT'],
];

var_dump($productData);

echo <<<'STORY'
======================================
        Generate Definition
======================================

STORY;
$helperTransfer = new HelperTransfer()
    ->fromArray([
        HelperTransfer::DEFINITION_PATH => '/home/transfer/transfer-object/doc/Helper/config/definition',
        HelperTransfer::CONTENT => [
            HelperContentTransfer::CLASS_NAME => 'Product',
            HelperContentTransfer::CONTENT => $productData,
        ],
    ]);

$generatedDefinitions = new HelperFacade()->generateDefinitions($helperTransfer);
echo 'Generated definitions: ' . $generatedDefinitions . PHP_EOL;

echo <<<'STORY'
======================================
        Generate Transfers
======================================

STORY;

$application = new Application('echo', '1.0.0');
$command = new GeneratorCommand();

$application->add($command);

$application->setDefaultCommand($command->getName(), true);

$input = new ArrayInput([
    '-c' => '/home/transfer/transfer-object/doc/Helper/config/generator.yml',
]);

$application->run($input);
