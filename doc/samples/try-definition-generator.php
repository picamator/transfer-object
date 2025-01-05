<?php

declare(strict_types=1);

use Picamator\Doc\Samples\TransferObject\Generated\DefinitionGenerator\ProductTransfer;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

require_once __DIR__ . '/../../vendor/autoload.php';

$projectRoot = getenv('PROJECT_ROOT') ?: '';

echo <<<'STORY'
=======================================================
              Imagine there is a Product
=======================================================

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
        ['name' => 'standard'],
    ],
    'details' => [
        'description' => 'Tomato from fields.',
        'isRegional' => true,
    ],
    'stores' => ['DE', 'AT'],
    'labels' => new ArrayObject([
       'sale' => 'Sale',
    ]),
    'availabilities' => [
        '2024-12-25' => [
            'total' => 100,
            'buffer' => 5,
        ],
        '2024-12-26' => [
            'total' => 200,
            'buffer' => 10,
        ],
    ],
    'measurementUnit' => [
        'palette' => [
            'type' => 'p',
            'items' => 1_000,
        ],
        'box' => [
            'type' => 'b',
            'items' => 10,
        ],
    ]
];

echo <<<'STORY'
=======================================================
              Generate Definition file
=======================================================

STORY;
$generatorTransfer = new DefinitionGeneratorTransfer()
    ->fromArray([
        DefinitionGeneratorTransfer::DEFINITION_PATH => $projectRoot
            . '/doc/samples/config/definition-generator/definition',
        DefinitionGeneratorTransfer::CONTENT => [
            DefinitionGeneratorContentTransfer::CLASS_NAME => 'Product',
            DefinitionGeneratorContentTransfer::CONTENT => $productData,
        ],
    ]);

$generatedDefinitions = new DefinitionGeneratorFacade()->generateDefinitions($generatorTransfer);

echo "Definitions $generatedDefinitions were successfully generated.\n";

echo <<<'STORY'
=======================================================
        Generate Transfer Objects
               with notice
   for demonstration exception handling was skipped
=======================================================

STORY;
$configPath = __DIR__ . '/config/definition-generator/generator.config.yml';
new TransferGeneratorFacade()->generateTransfersOrFail($configPath);

echo <<<'STORY'
=======================================================
        Try newly Generated Transfer Objects
                        &
          Validate $productData fits TO
=======================================================

STORY;

$productTransfer = new ProductTransfer()->fromArray($productData);

// ----- convert ArrayObject to string before comparison
$productData['labels'] = $productData['labels']->getArrayCopy();
var_dump($productData == $productTransfer->toArray());
