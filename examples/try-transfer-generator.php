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
     for demonstration exception handling was skipped
==============================================================

STORY;
$configPath = __DIR__ . '/config/transfer-generator/generator.config.yml';
new TransferGeneratorFacade()->generateTransfersOrFail($configPath);

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

echo <<<'STORY'
=================================================================
             Try protected properties (partly immutable)
=================================================================

STORY;
$credentialsTransfer = new CredentialsTransfer([
    CredentialsTransfer::LOGIN => 'jan.kowalski',
    CredentialsTransfer::TOKEN => 'some-random-token',
    CredentialsTransfer::CREATED_AT => '2025-05-02 22:58:00',
    CredentialsTransfer::UPDATED_AT => new DateTime(),
]);

echo "Login: $credentialsTransfer->login\n";
echo "Token: $credentialsTransfer->token\n";

var_dump($credentialsTransfer->toArray());
