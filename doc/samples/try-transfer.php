<?php

declare(strict_types=1);

use Picamator\Doc\Samples\TransferObject\Generated\AgentTransfer;
use Picamator\Doc\Samples\TransferObject\Generated\CustomerTransfer;
use Picamator\Doc\Samples\TransferObject\Generated\MerchantTransfer;
use Picamator\Doc\Samples\TransferObject\Generated\UserTransfer;

require_once __DIR__ . '/../../vendor/autoload.php';

echo <<<'STORY'
======================================
        Create Two Transfers
               &
             Debug
======================================

STORY;
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';

$merchantTransfer = new MerchantTransfer();
$merchantTransfer->merchantReference = 'PL-234-567';
$merchantTransfer->isActive = true;

var_dump($customerTransfer);
var_dump($merchantTransfer);

foreach ($merchantTransfer as $key => $value) {
    echo 'key: ' . $key . PHP_EOL;
    echo 'value: ' . $value . PHP_EOL;
}

echo <<<'STORY'
======================================
        Create another Transfer
======================================

STORY;
$agentTransfer = new AgentTransfer()
    ->fromArray([
        AgentTransfer::CUSTOMER => [
            CustomerTransfer::FIRST_NAME => 'Max',
            CustomerTransfer::LAST_NAME => 'Mustermann',
        ],
        AgentTransfer::MERCHANTS => [
            [
                MerchantTransfer::IS_ACTIVE => true,
                MerchantTransfer::MERCHANT_REFERENCE => 'DE-234-567',
            ], [
                MerchantTransfer::IS_ACTIVE => false,
                MerchantTransfer::MERCHANT_REFERENCE => 'AT-774-444',
            ],
        ],
    ]);

var_dump($agentTransfer->toArray());

echo <<<'STORY'
======================================
        And then Serialise
                &
       JSON Encode, Count it
======================================

STORY;
var_dump(serialize($agentTransfer));
var_dump(json_encode($agentTransfer));
var_dump($agentTransfer->count());

echo <<<'STORY'
======================================
           Copy TO
======================================

STORY;

$userTransfer = new UserTransfer()->fromArray($customerTransfer->toArray());
var_dump($userTransfer);
