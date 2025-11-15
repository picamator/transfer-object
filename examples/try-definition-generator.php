<?php

declare(strict_types=1);

use Picamator\Examples\TransferObject\Generated\DefinitionGenerator\ProductTransfer;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

require_once __DIR__ . '/../vendor/autoload.php';

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
        'description' => 'Local farm Bio Tomato.',
        'isRegional' => true,
    ],
    'stores' => ['DE', 'AT'],
    'labels' => [
       'sale' => 'Sale',
    ],
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
    ],
];

echo <<<'STORY'
=======================================================
              Generate Definition file
=======================================================

STORY;
$generatorTransfer = new DefinitionGeneratorTransfer(
    [
        DefinitionGeneratorTransfer::DEFINITION_PATH => __DIR__ . '/config/definition-generator/definition',
        DefinitionGeneratorTransfer::CONTENT => [
            DefinitionGeneratorContentTransfer::CLASS_NAME => 'Product',
            DefinitionGeneratorContentTransfer::CONTENT => $productData,
        ],
    ]
);

$generatedDefinitionCount = new DefinitionGeneratorFacade()->generateDefinitionsOrFail($generatorTransfer);

echo "Definitions $generatedDefinitionCount were successfully generated.\n";

echo <<<'STORY'
=======================================================
             Generate Transfer Objects
                   with notice
   for demo the exception handling was skipped
=======================================================

STORY;
$configPath = __DIR__ . '/config/definition-generator/generator.config.yml';
$generatedTransferCount = new TransferGeneratorFacade()->generateTransfersOrFail($configPath);

echo "Generated $generatedTransferCount transfer objects.\n";

echo <<<'STORY'
=======================================================
        Try newly Generated Transfer Objects
                       and
     validate how $productData fits Transfer Objects
=======================================================

STORY;

$productTransfer = new ProductTransfer()->fromArray($productData);

var_dump($productData == $productTransfer->toArray());
