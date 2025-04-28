![Transfer Object Generator](doc/img/transfer-object-generator.jpg)

[![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/picamator/transfer-object/actions)
[![License](https://poser.pugx.org/picamator/transfer-object/license)](https://packagist.org/packages/picamator/transfer-object)
[![PHP Version Require](https://poser.pugx.org/picamator/transfer-object/require/php)](https://packagist.org/packages/picamator/transfer-object)
[![Latest Stable Version](https://poser.pugx.org/picamator/transfer-object/v)](https://packagist.org/packages/picamator/transfer-object)

Transfer Object Generator
==========================

Would you like to build Symfony-compatible Transfer Objects easily?
You're in the right place!

Build Transfer Object by Blueprint
----------------------------------

Imagine you have a Rest API response:
```json
{
    "firstName": "Jan",
    "lastName": "Kowalski"
}
```

Running the following interactive [console command](https://github.com/picamator/transfer-object/wiki/Console-Commands#definition-generate):
```shell
$ ./vendor/bin/definition-generate
```

Generates a `YML` [definition file](https://github.com/picamator/transfer-object/wiki/Definition-File):
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

Then, running another [console command](https://github.com/picamator/transfer-object/wiki/Console-Commands#transfer-generate):
```shell
$ ./vendor/bin/transfer-generate [-c|--configuration CONFIGURATION]
```

Builds the Transfer Object:
```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

Key Features
------------

* **Symfony-compatible:**
  * includes Symfony commands: [TransferGeneratorCommand](/src/Command/TransferGeneratorCommand.php) and [DefinitionGeneratorCommand](/src/Command/DefinitionGeneratorCommand.php)
  * includes Symfony like services: [TransferGeneratorFacade](/src/TransferGenerator/TransferGeneratorFacade.php) and [DefinitionGeneratorFacade](/src/DefinitionGenerator/DefinitionGeneratorFacade.php)
  * mappable with Symfony request query string and payload
* **Transfer Object:**
  * implements methods: `fromArray()`, `toArray()`, and `toFilterArray()`
  * implements standard interfaces: `IteratorAggregate`, `JsonSerializable`, and `Countable`
  * supports nullable and not nullable property types
  * supports asymmetric protected property `set` visibility
  * supports `BackedEnum`
  * compatible with custom Data Transfer Object (DTO)

Installation
------------

Composer installation:

```shell
$ composer require picamator/transfer-object
```

Usage Tests
-----------

Definition Files and Transfer Object generators have been tested against API responses such as:

* [NASA Open Api](https://api.nasa.gov/neo/rest/v1/neo/2465633?api_key=DEMO_KEY)
* [OpenWeather](https://openweathermap.org/current#example_JSON)
* [Content API for Shopping](https://developers.google.com/shopping-content/guides/products/products-api?hl=en)
* [Frankfurter is a free, open-source currency data API](https://api.frankfurter.dev/v1/latest)
* [Tagesschau API](https://tagesschau.api.bund.dev)

### Test Scenario

1. Rest API response is used as a blueprint to generate Definition Files
2. Transfer Objects are generated based on Definition Files
3. Transfer Object instance is created with the API response
4. Transfer Object is converted back to the array
5. The converted array is compared with the API response

In all cases, data **100%** are matched.

Please check [DefinitionGeneratorFacadeTest](/tests/integration/DefinitionGenerator/DefinitionGeneratorFacadeTest.php) for more details.

### Service Samples

- [Definition Generator](/doc/samples/try-definition-generator.php)
- [Transfer Generator](/doc/samples/try-transfer-generator.php)
- [Advanced Transfer Generator](/doc/samples/try-advanced-transfer-generator.php)

### Practice

Definition Files and Transfer Objects generators use [Transfer Objects](/src/Generated).

Acknowledgment
--------------

Many thanks for your contribution, support, feedback and simply using the Transfer Object Generator!

Contribution
------------

If you find this project useful, please add a star to the repository. Follow the project to stay updated with all activities.
If you have suggestions for improvements or new features, feel free to create an issue or submit a pull request.
Here is a [Contribution Guide](CONTRIBUTING.md).


This project is released with a [Code of Conduct](CODE_OF_CONDUCT.md).
By participating in this project and its community, you agree to abide by those terms.

License
-------

Transfer Object Generator is free and open-source software licensed under the MIT License.
For more details, please see the [LICENSE](LICENSE) file.
