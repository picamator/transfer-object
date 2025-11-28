<?php

declare(strict_types=1);

use Picamator\Examples\TransferObject\Enum\CountryEnum;
use Picamator\Examples\TransferObject\Generated\TransferGenerator\AgentTransfer;
use Picamator\Examples\TransferObject\Generated\TransferGenerator\CredentialsTransfer;
use Picamator\Examples\TransferObject\Generated\TransferGenerator\CustomerTransfer;
use Picamator\Examples\TransferObject\Generated\TransferGenerator\MerchantTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

require_once __DIR__ . '/../vendor/autoload.php';

echo <<<'STORY'
==============================================================
           Generate Transfer Objects
                  with notice
     for demo the exception handling was skipped
==============================================================

STORY;
$configPath = __DIR__ . '/config/transfer-generator/generator.config.yml';
$generatedTransferCount = new TransferGeneratorFacade()->generateTransfersOrFail($configPath);

echo "Generated $generatedTransferCount transfer objects.\n";

echo <<<'STORY'
======================================================
        Try newly Generated Transfer Objects
======================================================

STORY;
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';

/** @var string $value */
foreach ($customerTransfer as $key => $value) {
    echo "key: $key, value: $value\n";
}

echo "CustomerTransfer properties count: {$customerTransfer->count()}\n}.";

$merchantTransfer = new MerchantTransfer();
$merchantTransfer->merchantReference = 'PL-234-567';
$merchantTransfer->country = CountryEnum::PL;
$merchantTransfer->isActive = true;

var_dump($merchantTransfer->toArray());

echo <<<'STORY'
======================================================
             Try how fromArray() works
======================================================

STORY;
$agentTransfer = new AgentTransfer()
    ->fromArray([
        AgentTransfer::CUSTOMER_PROP => [
            CustomerTransfer::FIRST_NAME_PROP => 'Max',
            CustomerTransfer::LAST_NAME_PROP => 'Mustermann',
        ],
        AgentTransfer::MERCHANTS_PROP => [
            [
                MerchantTransfer::COUNTRY_PROP => 'DE',
                MerchantTransfer::MERCHANT_REFERENCE_PROP => 'DE-234-567',
                MerchantTransfer::IS_ACTIVE_PROP => false,
            ], [
                MerchantTransfer::COUNTRY_PROP => 'PL',
                MerchantTransfer::MERCHANT_REFERENCE_PROP => 'PL-774-444',
                MerchantTransfer::IS_ACTIVE_PROP => true,
            ],
        ],
        'uuid' => '123-123-123-123',
    ]);

var_dump($agentTransfer->toArray());

echo <<<'STORY'
=================================================================
             Try protected properties (partly immutable)
=================================================================

STORY;
$credentialsTransfer = new CredentialsTransfer([
    CredentialsTransfer::LOGIN_PROP => 'jan.kowalski',
    CredentialsTransfer::TOKEN_PROP => 'some-random-token',
    CredentialsTransfer::CREATED_AT_PROP => '2025-05-02 22:58:00',
    CredentialsTransfer::UPDATED_AT_PROP => new DateTime(),
]);

echo "Login: $credentialsTransfer->login\n";
echo "Token: $credentialsTransfer->token\n";

var_dump($credentialsTransfer->toArray());
