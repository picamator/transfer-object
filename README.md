![Transfer Object Generator](.github/transfer-object-generator.jpg)

[![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/picamator/transfer-object/actions)
[![License](https://poser.pugx.org/picamator/transfer-object/license)](https://packagist.org/packages/picamator/transfer-object)
[![OpenSSF Best Practices](https://www.bestpractices.dev/projects/11465/badge)](https://www.bestpractices.dev/projects/11465)
[![PHP Version Require](https://poser.pugx.org/picamator/transfer-object/require/php)](https://packagist.org/packages/picamator/transfer-object)
[![Symfony Compatibility](https://img.shields.io/badge/Symfony-%5E8.0-blue)](https://github.com/picamator/transfer-object/tree/development?tab=readme-ov-file#key-features)
[![Wiki](https://img.shields.io/badge/wiki-available-brightgreen)](https://github.com/picamator/transfer-object/wiki)
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

Then, running [console command](https://github.com/picamator/transfer-object/wiki/Console-Commands#transfer-generate):

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

**Symfony Compatibility:**

 * Provides Symfony console command:
   * [TransferGeneratorCommand](https://github.com/picamator/transfer-object/wiki/Console-Commands#transfer-generate)
   * [TransferGeneratorBulkCommand](https://github.com/picamator/transfer-object/wiki/Console-Commands#transfer-generate-bulk)
   * [DefinitionGeneratorCommand](https://github.com/picamator/transfer-object/wiki/Console-Commands#definition-generate)
 * Includes Symfony services:
   * [TransferGeneratorFacade](https://github.com/picamator/transfer-object/wiki/Facade-Interfaces#transfer-object-generator)
   * [DefinitionGeneratorFacade](https://github.com/picamator/transfer-object/wiki/Facade-Interfaces#definition-generator)
 * Enables automatic Symfony request query data mapping
 * Supports [Symfony validator](https://github.com/picamator/transfer-object/wiki/Definition-File#attributes) attributes

**Transfer Object:**

* Offers methods:
  * `fromArray()`
  * `toArray()`
* Implements standard interfaces:
  * `IteratorAggregate`
  * `JsonSerializable`
  * `Countable`
* Handles embedded and collection Transfer Objects.
* Works with PHP primitive data types.
* Extends compatibility to advanced types:
  * `BackedEnum`
  * `DateTime`
  * `DateTimeImmutable`
  * `BcMath\Number`
* Supports asymmetric property visibility.
* Integrates with external Transfer Objects.

Installation
------------

Composer installation:

```console
$ composer require picamator/transfer-object
```

| Version | PHP | Symfony |
|-------|-----|---------|
| 4.0.0 | 8.4 | 7.3     |
| 5.0.0 | 8.5 | 8.0     |

Documentation
-------------

* [Examples](examples#readme)
* [Project's Wiki](https://github.com/picamator/transfer-object/wiki)

Publications
------------

1. [Sergii Pryz, "Data Transfer Objects and Property Hooks" PHP Architect Magazine, June 2025](https://www.phparch.com/article/2025-06-data-transfer-objects-and-property-hooks/)

Acknowledgment
--------------

Many thanks ❤️ for your contribution, support, feedback and simply using the Transfer Object Generator!

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

Security Commitment
-------------------

The project applies [OpenSSF Best Practices](https://www.bestpractices.dev/en/projects/11465/passing).

For reporting security vulnerabilities, please follow [Security Policy](https://github.com/picamator/transfer-object/security/policy).

License
-------

Transfer Object Generator is free and open-source software licensed under the MIT License.

For more details, please see the [LICENSE](LICENSE) file.
