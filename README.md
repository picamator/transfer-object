Transfer Object Generator
==========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Transfer Object (or further TO) Generator is based on:

- PHP 8.4 property hooks
- FixedArray as a main storage
- Interface to transform `from` and `to` Array as well as between TOs
- Interfaces such as `IteratorAggregate`, `JsonSerializable`, `Serializable`, `Countable` interfaces

TO Generator includes console commands and helper classes to:

- Build TOs based on `YML` definitions
- Build `YML` defintions based on `JSON`

Samples
-----------
New TO with their properties set looks like

```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

In order to see how converting from array, to transfer or iterate over the TO,
please check [Try Samples](/doc/Samples/try-samples.php) script.

Installation
------------

```bash
composer require-dev picamator/transfer-object
```

Usage
-----

### Terminal
After installation TO generator command `generate-transfer` is available on `./vendor/bin` directory.

```bash
./vendor/bin/generate-transfer -c [path to configuration file]
```

### Helper (experimental)
Helper class allows to generate TO definitions based on object's data e.g. API response, ORM entity etc.

For instance:

```php
$productData = [
    'sku' => 'T-123',
    'name' => 'Tomato',
];
```

Snippet [try-helper.php](/doc/Helper/try-helper.php) shows how to generate TO definitions and based on them how to generate TOs.

The second part [try-helper-part-2.php](/doc/Helper/try-helper-part-2.php) validates newly generated TOs.

_Note_: Experimental feature works only for the well structured data, resolving `null` type as a `string`.

Configuration File
------------------
The configuration is an `YML` file, which includes namespace, path to definitions and generated classes.

```yml
generator:
  transferNamespace: "Picamator\\TransferObject\\Generated"
  transferPath: "/home/transfer/transfer-object/src/TransferObject/Generated"
  definitionPath: "/home/transfer/transfer-object/config/definition"
```

| Key Name | Description                              |
| ---|------------------------------------------|
| `generator` | Configuration name.                      |
| `transferNamespace` | TO namespace.                            |
| `transferPath` | Path where generated TO should be saved. |
| `definitionPath` | Path where TO definition is located.     |

See [Configuration Sample](/doc/Samples/config/generator.yml) for more details.

Definition
----------
The TO defintion is an `YML` file, that can contain one or many definitions.

 - Each root level is a new TO name
 - Second level is a property name
 - Third level is a property type supporting only two keys `type` and `collectionType`

For example, definition for `CustomerTransfer` with two `string` properties

```yml
Customer:
    firstName:
        type: string
    lastName:
        type: string
```

More can be found on [Definition Sample](/doc/Samples/config/definition) for more details.

### Definition Types
| Definition File Key | Supported Values                                                                             | Details                                                              |
|---------------------|----------------------------------------------------------------------------------------------|----------------------------------------------------------------------|
| type                | `bool`, `true`, `false`, `int`, `float`, `string`, `array`, `ArrayObject`, `iterable` | One of the listed values without Union `\|`.                         |
| type                | Any TO name without prefix `Transfer`.                                                       | Generated property will have the coresponding TO type.               |
| collectionType      | Any TO name without prefix `Transfer`.                                                       | Generated property will have `ArrayObject` where each element is TO. |


Development
-----------
TO Generator provides Docker environment with one container `transfer-object-php`.

In order to start working install [Docker](https://docs.docker.com/engine/install/) and [Docker Compose](https://docs.docker.com/compose/install/) first.

To start working following commands should be executed:

1. Build containers: `docker compose build`
2. Start container (will run composer install): `docker compose up`

### Composer Scripts
Table below shows how to run specific composer scripts on Docker Container

| Name             | Command                                                                 |
|------------------|-------------------------------------------------------------------------|
| PHPStan          | `docker compose run transfer-object-php composer phpstan`               ||
| PHPUnit          | `docker compose run transfer-object-php composer phpunit`                  |
| Generate TOs     | `docker compose run transfer-object-php composer generate-transfer -c /home/transfer/transfer-object/config/generator.yml` |
| Generate Samples | `docker compose run transfer-object-php composer generate-transfer -c /home/transfer/transfer-object/doc/Samples/config/generator.yml` |

Contribution
------------
If you find this project worth to use please add a star. Follow changes to see all activities.
And if you see room for improvement, proposals please feel free to create an issue or send pull request.
Here is a great [guide to start contributing](https://guides.github.com/activities/contributing-to-open-source/).

Please note that this project is released with a [Contributor Code of Conduct](http://contributor-covenant.org/version/1/4/).
By participating in this project and its community you agree to abide by those terms.

License
-------
Transfer Object Generator is licensed under the MIT License. Please see the [LICENSE](LICENSE) file for details.
