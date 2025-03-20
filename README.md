![Transfer Object Generator](doc/img/transfer-object-generator.jpg)

[![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/picamator/transfer-object/actions)
[![License](https://poser.pugx.org/picamator/transfer-object/license)](https://packagist.org/packages/picamator/transfer-object)
[![PHP Version Require](https://poser.pugx.org/picamator/transfer-object/require/php)](https://packagist.org/packages/picamator/transfer-object)
[![Latest Stable Version](https://poser.pugx.org/picamator/transfer-object/v)](https://packagist.org/packages/picamator/transfer-object)

Transfer Object Generator
==========================

Would you like to build lightweight Transfer Objects (TO) easily?
You're in the right place!

Build TOs Using an Array as a Blueprint
---------------------------------------

Imagine you have an array:
```php
$data = [
    'firstName' => 'Jan',
    'lastName' => 'Kowalski'
];
```

TO facade method helps to convert the array into a `YML` definition file:
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

The generator console command builds TO based on the definition file:
```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

How it works in action can be found on Wiki:
 - [Try Sample to generate Definition files](/doc/samples/try-definition-generator.php)
 - [Try Sample to generate TOs](/doc/samples/try-transfer-generator.php)
 - [Try Advanced Sample to generate TOs](/doc/samples/try-advanced-transfer-generator.php)

Key Features
------------

* **Interface methods:** implements `fromArray()`, `toArray()`
* **Standard interfaces:** implements `IteratorAggregate`, `JsonSerializable`, and `Countable`
* **Lightweight:** TO includes only data without any business logic
* **Nullable:** supports both attribute types nullable and not nullable (`required:`)
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

Run command bellow to generate Transfer Objects:

```shell
$ ./vendor/bin/generate-transfer [-c|--configuration CONFIGURATION]
```

Please check Wiki for more details:
- [Command Configuration](https://github.com/picamator/transfer-object/wiki/Command-Configuration)
- [Definition File](https://github.com/picamator/transfer-object/wiki/Definition-File)

### Facade Interface

Facade interface `DefinitionGeneratorFacadeInterface` is used to generate the `YML`
definition file based on the array.

Please check Wiki for more details:
- [Facade Interfaces](https://github.com/picamator/transfer-object/wiki/Facade-Interfaces)
- [Visualizing Diagrams](https://github.com/picamator/transfer-object/wiki/Visualising-Diagrams)

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
