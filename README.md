Transfer Object Generator
==========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Transfer Object (or further TO) Generator creates TO with:

- PHP 8.4 property Hooks
- FixedArray as a main storage
- Transformation from and to Array as well as between TOs
- Implementation `IteratorAggregate`, `JsonSerializable`, `Serializable`, `Countable` interfaces

TO Generator includes console commands:

- Build TOs based on `YML` definitions
- Build `YML` defintions based on `JSON`

Installation
------------

```bash
composer require-dev picamator/transfer-object
```

Usage
-----

```bash
./vendor/bin/generate-transfer -c [path to configuration file]
```

Configuration File
------------------

Configuraration is an `YML file includes namsepace, path to definitions and generated classes.

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
| `definitionPath` | Path where TO Definition is located.     |

See [Configuration Sample](/doc/Samples/generator.yml) for more details.

Definition
----------
TO Defintion is an `YML` file, that can contains one or many defitiotions.

 - Each root level is a new TO name
 - Second level is a property name
 - Third level is a property type supporting only tww keys `type` and `collectionType`

For example, defintion for `CustomerTransfer` with two `string` properties

```yml
Customer:
    firstName:
        type: string
    lastName:
        type: string
```

More can be found on [Definition Sample](/doc/Samples/definitions) for more details.

### Defintion Types
| Definition File Key | Supported Values                                                                               | Details                                                              |
|---------------------|------------------------------------------------------------------------------------------------|----------------------------------------------------------------------|
| type                | `bool`, `true`, `false`, `int`, `float`, `string`, `array`, `ArrayObject`, `mixed`, `iterable` | One of the listed values without Union `\|`.                         |
| type                | Any TO name without prefix `Transfer`.                                                         | Generated property will have the coresponding TO type.               |
| collectionType      | Any TO name without prefix `Transfer`.                                                         | Generated property will have `ArrayObject` where each element is TO. |


Development Environemnt
-----------------------
TO Generator provides Docker environment with one container `transfer-object-php`.

In order to star working install [Docker](https://docs.docker.com/engine/install/) and [Docker Compose](https://docs.docker.com/compose/install/) first.

To start working following command should be executed:

1. Build containers: `docker compose build`
2. Start start container (will run coponser install): `docker compose up`

### Composer Scripts
Table bellow shows how to run specific composer srcripts on Docker Container

| Name     | Command                                                                 |
|----------|-------------------------------------------------------------------------|
| PHPStan     | `docker compose run transfer-object-php composer phpstan`               ||
| PHPUnit  | `docker compose run transfer-object-php composer test`                  |
| Generate TOs | `docker compose run transfer-object-php composer generate-transfer -c /home/transfer/transfer-object/config/generator.yml` |
