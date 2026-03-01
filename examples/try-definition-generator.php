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

/** @var string $product */
$product = file_get_contents(__DIR__ . '/data/product.json');
/** @var array<string, mixed> $productData */
$productData = json_decode($product, associative: true, flags: JSON_THROW_ON_ERROR);

echo <<<'STORY'
=======================================================
              Generate Definition file
=======================================================

STORY;
$generatorTransfer = new DefinitionGeneratorTransfer(
    [
        DefinitionGeneratorTransfer::DEFINITION_PATH_PROP => __DIR__ . '/config/definition-generator/definition',
        DefinitionGeneratorTransfer::CONTENT_PROP => [
            DefinitionGeneratorContentTransfer::CLASS_NAME_PROP => 'Product',
            DefinitionGeneratorContentTransfer::CONTENT_PROP => $productData,
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
