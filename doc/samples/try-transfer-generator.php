<?php

declare(strict_types=1);

use Picamator\Doc\Samples\TransferObject\Enum\CountryEnum;
use Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator\AgentTransfer;
use Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator\CustomerTransfer;
use Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator\MerchantTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

require_once __DIR__ . '/../../vendor/autoload.php';

echo <<<'STORY'
======================================================
           Generate Transfer Objects
        Note: for demo error handles were skipped
======================================================

STORY;
$transferGeneratorFacade = new TransferGeneratorFacade();

// ----- Load Configuration
$configPath = __DIR__ . '/config/transfer-generator/generator.config.yml';
$configTransfer = $transferGeneratorFacade->loadConfig($configPath);

// ----- Generate Transfer Objects
$transferGeneratorFacade->generateTransfers();

echo <<<'STORY'
======================================================
        Try newly Generated Transfer Objects
======================================================

STORY;
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';

$merchantTransfer = new MerchantTransfer();
$merchantTransfer->merchantReference = 'PL-234-567';
$merchantTransfer->country = CountryEnum::PL;
$merchantTransfer->isActive = true;

var_dump($customerTransfer->toArray());
var_dump($merchantTransfer);

echo <<<'STORY'
======================================================
             Try how fromArray works
======================================================

STORY;
$agentTransfer = new AgentTransfer()
    ->fromArray([
        AgentTransfer::CUSTOMER => [
            CustomerTransfer::FIRST_NAME => 'Max',
            CustomerTransfer::LAST_NAME => 'Mustermann',
        ],
        AgentTransfer::MERCHANTS => [
            [
                MerchantTransfer::COUNTRY => 'DE',
                MerchantTransfer::MERCHANT_REFERENCE => 'DE-234-567',
                MerchantTransfer::IS_ACTIVE => false,
            ], [
                MerchantTransfer::COUNTRY => 'PL',
                MerchantTransfer::MERCHANT_REFERENCE => 'PL-774-444',
                MerchantTransfer::IS_ACTIVE => true,
            ],
        ],
        'uuid' => '123-123-123-123',
    ]);

var_dump($agentTransfer->toArray());
