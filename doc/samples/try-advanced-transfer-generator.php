<?php

declare(strict_types=1);

use Picamator\Doc\Samples\TransferObject\Advanced\CredentialsData;
use Picamator\Doc\Samples\TransferObject\Generated\AdvancedTransferGenerator\AdvancedCustomerTransfer;
use Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator\CustomerTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

require_once __DIR__ . '/../../vendor/autoload.php';

echo <<<'STORY'
=========================================================
         How to Plugin custom Transfer Object
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
     It implements TransferInterface with a dummy logic
============================================================================

STORY;
$credentialsData = new CredentialsData();
$credentialsData->login = 'jan.kowalski';
$credentialsData->token = 'some-random-token';

echo <<<'STORY'
=============================================================
           Create a definition to combine both objects
=============================================================

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
