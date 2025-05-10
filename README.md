![Transfer Object Generator](.github/transfer-object-generator.jpg)

[![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/picamator/transfer-object/actions)
[![License](https://poser.pugx.org/picamator/transfer-object/license)](https://packagist.org/packages/picamator/transfer-object)
[![PHP Version Require](https://poser.pugx.org/picamator/transfer-object/require/php)](https://packagist.org/packages/picamator/transfer-object)
[![Latest Stable Version](https://poser.pugx.org/picamator/transfer-object/v)](https://packagist.org/packages/picamator/transfer-object)

Transfer Object Generator
==========================

Would you like to build Symfony-compatible Transfer Objects?

You're in the right place! 🎉

Imagine you have a Rest API response:

```json
{
    "firstName": "Jan",
    "lastName": "Kowalski"
}
```

Running the following interactive [console command](https://github.com/picamator/transfer-object/wiki/Console-Commands#definition-generate):

```console
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

```console
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

**Symfony Compatability:**

 * includes Symfony console commands:
   * [TransferGeneratorCommand](/src/Command/TransferGeneratorCommand.php)
   * [DefinitionGeneratorCommand](/src/Command/DefinitionGeneratorCommand.php)
 * includes Symfony services:
   * [TransferGeneratorFacade](/src/TransferGenerator/TransferGeneratorFacade.php)
   * [DefinitionGeneratorFacade](/src/DefinitionGenerator/DefinitionGeneratorFacade.php)
 * supports Symfony request data mapping

**Transfer Object:**

* implements methods:
  * `fromArray()`
  * `toArray()`
  * `toFilterArray()`
* implements standard interfaces:
  * `IteratorAggregate`
  * `JsonSerializable`
  * `Countable`
* supports embedded and collection Transfer Objects
* supports PHP primitive data types
* supports:
  * `BackedEnum`
  * `DateTime`
  * `DateTimeImmutable`
  * `BcMath\Number`
* supports asymmetric property visibility
* integrates external Transfer Objects

Installation
------------

Composer installation:

```console
$ composer require picamator/transfer-object
```

Examples
---------

* [Definition Generator](/examples/try-definition-generator.php)
* [Transfer Generator](/examples/try-transfer-generator.php)
* [Advanced Transfer Generator](/examples/try-advanced-transfer-generator.php)

Usage Tests
-----------

Definition Files and Transfer Object generators have been tested against following APIs:

* [NASA Open Api](https://api.nasa.gov/neo/rest/v1/neo/2465633?api_key=DEMO_KEY)
* [OpenWeather](https://openweathermap.org/current#example_JSON)
* [Content API for Shopping](https://developers.google.com/shopping-content/guides/products/products-api?hl=en)
* [Frankfurter is a free, open-source currency data API](https://api.frankfurter.dev/v1/latest)
* [Tagesschau API](https://tagesschau.api.bund.dev)

### Scenario

1. Rest API response is used as a blueprint to generate Definition Files
2. Transfer Objects are generated based on Definition Files
3. Transfer Object instance is created with the API response
4. Transfer Object is converted back to the array
5. The converted array is compared with the API response

In all cases, data **100%** are matched ✅.

For detailed information, please check [DefinitionGeneratorFacadeTest](/tests/integration/DefinitionGenerator/DefinitionGeneratorFacadeTest.php).

Acknowledgment
--------------

Many thanks for your contribution, support, feedback and simply using the Transfer Object Generator! ❤️

Contribution
------------

If you find this project useful, please ⭐ star the repository.
Follow the project to stay updated with all activities.

If you have suggestions for improvements or new features, feel free to:

* Create an issue
* Submit a pull request

Here is a [Contribution Guide](CONTRIBUTING.md).


This project is released with a [Code of Conduct](CODE_OF_CONDUCT.md).
By participating in this project and its community, you agree to abide by those terms.

License
-------

Transfer Object Generator is free and open-source software licensed under the MIT License.

For more details, please see the [LICENSE](LICENSE) file.
