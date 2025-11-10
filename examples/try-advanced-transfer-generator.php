<?php

declare(strict_types=1);

use Picamator\Examples\TransferObject\Advanced\AddressData;
use Picamator\Examples\TransferObject\Advanced\CredentialsData;
use Picamator\Examples\TransferObject\Generated\AdvancedTransferGenerator\AdvancedCustomerTransfer;
use Picamator\Examples\TransferObject\Generated\TransferGenerator\CustomerTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

require_once __DIR__ . '/../vendor/autoload.php';

echo <<<'STORY'
=======================================================
       How to use custom Data Transfer Object
                        and
        Apply Transfer Object across modules
=======================================================

STORY;

echo <<<'STORY'
=======================================================
Let's take Generated\TransferGenerator\CustomerTransfer
=======================================================

STORY;
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Ignacy';
$customerTransfer->lastName = 'Rzecki';

echo <<<'STORY'
=======================================================
          Let's take Advanced\CredentialsData
                      use
            DummyTransferAdapterTrait
=======================================================

STORY;
$credentialsData = new CredentialsData();
$credentialsData->login = 'ignacy.rzecki';
$credentialsData->token = 'Lalka';

$encodedCredentialsData = json_encode($credentialsData);
$iteratedCredentialsData = implode(', ', iterator_to_array($credentialsData));

echo <<<DEBUG
Count: {$credentialsData->count()}
JSON encode: $encodedCredentialsData
Iterated: [$iteratedCredentialsData]

DEBUG;


echo <<<'STORY'
=======================================================
           Let's take Advanced\AddressData
                     use
             TransferAdapterTrait
=======================================================

STORY;
$addressData = new AddressData();
$addressData->street = 'Krakowskie Przedmieście';
$addressData->houseNumber = '9';
$addressData->city = 'Warszawa';
$addressData->postCode = '00-068';
$addressData->country = 'Polska';

$encodedAddressData = json_encode($addressData);

$iteratedAddressData = implode(', ', iterator_to_array($addressData));

echo <<<DEBUG
Count: {$addressData->count()}
JSON encode: $encodedAddressData
Iterated: [$iteratedAddressData]

DEBUG;


echo <<<'STORY'
=======================================================
    Create a Definition file combining all objects
=======================================================

AdvancedCustomer:
  customer:
    type: "Picamator\\Examples\\TransferObject\\Generated\\TransferGenerator\\CustomerTransfer"
  address:
    type: "Picamator\\Examples\\TransferObject\\Advanced\\AddressData"
  credentials:
    type: "Picamator\\Examples\\TransferObject\\Advanced\\CredentialsData"


STORY;

echo <<<'STORY'
=======================================================
           Generate Transfer Object
                  with notice
    for demo the exception handling was skipped
=======================================================

STORY;
$configPath = __DIR__ . '/config/advanced-transfer-generator/generator.config.yml';
new TransferGeneratorFacade()->generateTransfersOrFail($configPath);

echo <<<'STORY'
=======================================================
        Try newly Generated Transfer Object
=======================================================

STORY;

$advancedCustomerTransfer = new AdvancedCustomerTransfer();
$advancedCustomerTransfer->customer = $customerTransfer;
$advancedCustomerTransfer->address = $addressData;
$advancedCustomerTransfer->credentials = $credentialsData;

var_dump($advancedCustomerTransfer->toArray());

echo <<<'STORY'
=======================================================
              Try how fromArray() works
=======================================================

STORY;
$advancedCustomerTransfer = new AdvancedCustomerTransfer()
    ->fromArray([
        AdvancedCustomerTransfer::CUSTOMER => [
            CustomerTransfer::FIRST_NAME => 'Theodor',
            CustomerTransfer::LAST_NAME => 'Storm',
        ],
        AdvancedCustomerTransfer::ADDRESS => [
            'street' => 'Wasserreihe',
            'houseNumber' => '31',
            'city' => 'Husum',
            'postCode' => '25813',
            'country' => 'Deutschland',
        ],
        AdvancedCustomerTransfer::CREDENTIALS => [
            'login' => 'theodor.storm',
            'token' => 'Der Schimmelreiter',
        ],
    ]);

var_dump($advancedCustomerTransfer->toArray());
