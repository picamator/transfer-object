<?php declare(strict_types=1);

use Picamator\TransferObject\Samples\Generated\AgentTransfer;
use Picamator\TransferObject\Samples\Generated\CustomerTransfer;
use Picamator\TransferObject\Samples\Generated\MerchantTransfer;
use Picamator\TransferObject\Samples\Generated\UserTransfer;

require_once __DIR__. '/../../vendor/autoload.php';

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

echo <<<'STORY'
======================================
        Create another Transfer
                &
             Iterate
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

foreach ($agentTransfer->customer as $key => $value) {
    echo 'key: ' . $key . PHP_EOL;
    echo 'value: ' . $value . PHP_EOL;
}

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
           Copy
            &
     Compare with Original
======================================

STORY;
$copiedAgentTransfer = new AgentTransfer()->fromTransfer($agentTransfer);

var_dump($copiedAgentTransfer->customer === $agentTransfer->customer);
var_dump($copiedAgentTransfer->merchants[0] === $agentTransfer->merchants[0]);

$userTransfer = new UserTransfer();
var_dump($userTransfer->fromTransfer($customerTransfer)->toArray());
var_dump($customerTransfer->toTransfer(new UserTransfer())->toArray());

echo <<<'STORY'
======================================
           Clone
             &
     Compare with Original
======================================

STORY;
$clonedAgentTransfer = clone $agentTransfer;
var_dump($clonedAgentTransfer === $agentTransfer);
var_dump($clonedAgentTransfer->merchants[0] === $agentTransfer->merchants[0]);
var_dump($clonedAgentTransfer->customer === $agentTransfer->customer);
