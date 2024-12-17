<?php declare(strict_types=1);

use Picamator\TransferObject\Helper\Generated\ProductTransfer;

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
        Use newly Generated
======================================

STORY;
$productTransfer = new ProductTransfer()->fromArray($productData);

var_dump($productTransfer);
