![Transfer Object Generator](doc/img/transfer-object-generator.jpg)

[![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/picamator/transfer-object/actions)
[![License](https://poser.pugx.org/picamator/transfer-object/license)](https://packagist.org/packages/picamator/transfer-object)
[![PHP Version Require](https://poser.pugx.org/picamator/transfer-object/require/php)](https://packagist.org/packages/picamator/transfer-object)
[![Latest Stable Version](https://poser.pugx.org/picamator/transfer-object/v)](https://packagist.org/packages/picamator/transfer-object)

Transfer Object Generator
==========================

Would you like to build lightweight Symfony-compatible Transfer Objects (TO) easily?
You're in the right place!

Build TOs Using JSON as a Blueprint
------------------------------------

Imagine you have an JSON API Response/Payload:
```json
{
    "firstName": "Jan",
    "lastname": "Kowalski"
}
```
Running the following console command:
```shell
$ ./vendor/bin/definition-generate
```

Generates a `YML` definition file:
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

Then, running another console command:
```shell
$ ./vendor/bin/transfer-generate [-c|--configuration CONFIGURATION]
```

Builds the TO:
```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

Key Features
------------

* **Symfony-compatible commands:**
  * Includes [TransferGeneratorCommand](/src/Command/TransferGeneratorCommand.php) and [DefinitionGeneratorCommand](/src/Command/DefinitionGeneratorCommand.php) as Symfony commands
  * [TransferGeneratorFacade](/src/TransferGenerator/TransferGeneratorFacade.php) and [DefinitionGeneratorFacade](/src/DefinitionGenerator/DefinitionGeneratorFacade.php) can be integrated as Symfony services
* **Interface methods:** implements `fromArray()`, `toArray()`, `toFilterArray()`
* **Standard interfaces:** implements `IteratorAggregate`, `JsonSerializable`, and `Countable`
* **Lightweight:** TO includes only data without any business logic
* **Nullable:** supports nullable and not nullable property types
* **Protected** supports asymmetric visibility for properties `set`
* **BackedEnum:** supports `BackedEnum`
* **Adaptable:** compatible with custom Data Transfer Object (DTO) implementation

Installation
------------

Composer installation:

```shell
$ composer require picamator/transfer-object
```

Usage
-----

### Terminal

Run the following command to generate Transfer Objects:
```shell
$ ./vendor/bin/transfer-generate [-c|--configuration CONFIGURATION]
```

Run the following command to generate Definition files:
```shell
$ ./vendor/bin/definition-generate
```

For more details, check the Wiki:
- [Console Commands](https://github.com/picamator/transfer-object/wiki/Console-Commands)
- [Definition File](https://github.com/picamator/transfer-object/wiki/Definition-File)

### Facade Interface

Please check Wiki:
- [Facade Interfaces](https://github.com/picamator/transfer-object/wiki/Facade-Interfaces)
- [Visualizing Diagrams](https://github.com/picamator/transfer-object/wiki/Visualising-Diagrams)

Explore usage samples:
- [Definition Generator](/doc/samples/try-definition-generator.php)
- [Transfer Generator](/doc/samples/try-transfer-generator.php)
- [Advanced Transfer Generator](/doc/samples/try-advanced-transfer-generator.php)


Usage Tests
-----------

Definition and TO generators have been tested against API responses such as:

* [NASA Open Api](https://api.nasa.gov/neo/rest/v1/neo/2465633?api_key=DEMO_KEY)
* [OpenWeather](https://openweathermap.org/current#example_JSON)
* [Content API for Shopping](https://developers.google.com/shopping-content/guides/products/products-api?hl=en)
* [Frankfurter is a free, open-source currency data API](https://api.frankfurter.dev/v1/latest)
* [Tagesschau API](https://tagesschau.api.bund.dev)

### Test Scenario

1. JSON response is used as a blueprint to generate Definition files and then TOs.
2. Generated TO instance is created with the `JSON` data.
3. The TO instance is converted to an array by running the `toArray()` method.
4. The converted array is compared to the decoded `JSON` blueprint.

In all cases the compared data were **100%** matched.

More details are in the integration test [DefinitionGeneratorFacadeTest](/tests/integration/DefinitionGenerator/DefinitionGeneratorFacadeTest.php).

Additionally, TO and Definition generators are using TO, therefore, checking source code helps to see TOs usage in practice.

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
