<?php

declare(strict_types=1);

use Picamator\Doc\Samples\TransferObject\Advanced\CredentialsData;
use Picamator\Doc\Samples\TransferObject\Generated\AdvancedTransferGenerator\AdvancedCustomerTransfer;
use Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator\CustomerTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

require_once __DIR__ . '/../../vendor/autoload.php';

echo <<<'STORY'
=========================================================
       How to use custom Data Transfer Object
                        &
      apply Transfer Object cross modules link
=========================================================

STORY;

echo <<<'STORY'
============================================================================
         Lets take CustomerTransfer form Generated\TransferGenerator
============================================================================

STORY;
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';

echo <<<'STORY'
============================================================================
            Lets take CredentialsData form Advanced
                             &
       implements TransferInterface using DummyTransferAdapterTrait
============================================================================

STORY;
$credentialsData = new CredentialsData();
$credentialsData->login = 'jan.kowalski';
$credentialsData->token = 'some-random-token';

$encodedCredentialsData = json_encode($credentialsData);

$serializedCredentialsData = serialize($credentialsData);
$unserializedCredentialsData = unserialize($serializedCredentialsData);

$iteratedCredentialsData = implode(', ', iterator_to_array($credentialsData->getIterator()));

echo <<<DEBUG
Count: {$credentialsData->count()}
JSON encode: $encodedCredentialsData
Serialized: $serializedCredentialsData
Iterated: [$iteratedCredentialsData]

DEBUG;

echo <<<'STORY'
===================================================================
           Create a Definition file combining both objects
===================================================================

AdvancedCustomer:
  customer:
    type: 'Picamator\\Doc\\Samples\\TransferObject\\Generated\\TransferGenerator\\CustomerTransfer'
  credentials:
    type: 'Picamator\\Doc\\Samples\\TransferObject\\Advanced\\CredentialsData'


STORY;

echo <<<'STORY'
======================================================
           Generate Transfer Objects
======================================================

STORY;
$configPath = __DIR__ . '/config/advanced-transfer-generator/generator.config.yml';
new TransferGeneratorFacade()->generateTransfersOrFail($configPath);

echo <<<'STORY'
======================================================
        Try newly Generated Transfer Object
                    &
                  Debug
======================================================

STORY;

$advancedCustomerTransfer = new AdvancedCustomerTransfer();
$advancedCustomerTransfer->customer = $customerTransfer;
$advancedCustomerTransfer->credentials = $credentialsData;

var_dump($advancedCustomerTransfer->toArray());

echo <<<'STORY'
======================================================
                Convert fromArray
======================================================

STORY;
$advancedCustomerTransfer = new AdvancedCustomerTransfer()->fromArray([
    AdvancedCustomerTransfer::CUSTOMER => [
        CustomerTransfer::FIRST_NAME => 'Max',
        CustomerTransfer::LAST_NAME => 'Mustermann',
    ],
    AdvancedCustomerTransfer::CREDENTIALS => [],
]);

var_dump($advancedCustomerTransfer->toArray());
