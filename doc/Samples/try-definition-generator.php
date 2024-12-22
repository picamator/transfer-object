<?php declare(strict_types=1);

use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\Generated\HelperContentTransfer;
use Picamator\TransferObject\Generated\HelperTransfer;

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
        HelperTransfer::DEFINITION_PATH => '/home/transfer/transfer-object/doc/Samples/config/definition',
        HelperTransfer::CONTENT => [
            HelperContentTransfer::CLASS_NAME => 'Product',
            HelperContentTransfer::CONTENT => $productData,
        ],
    ]);

$generatedDefinitions = new DefinitionGeneratorFacade()->generateDefinitions($helperTransfer);
echo 'Generated definitions: ' . $generatedDefinitions . PHP_EOL;
