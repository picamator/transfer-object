Transfer Object Generator
==========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Transfer Object (or further TO) Generator creates TO with:

- PHP 8.4 property Hooks
- FixedArray as a main storage
- Transformation from and to Array as well as between TOs
- Implementation `IteratorAggregate`, `JsonSerializable`, `Serializable`, `Countable` interfaces

TO Generator includes console commands:

- Build TOs based on `YML` defintions
- Build `YML` defintions based on `JSON`


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

### Defintion Types
@todo

Generated Object
----------------
@todo

Development Environemnt
-----------------------

TO Generator provides Docker environment with one container `transfer-object-php`.

In order to star working install [Docker](https://docs.docker.com/engine/install/) and [Docker Compose](https://docs.docker.com/compose/install/) first.

To start working following command should be executed:


1. Build containers: `docker compose build`
2. Start start container (will run coponser install): `docker compose -f docker/docker-compose.yml up`

### Composer Scripts
Table bellow shows how to run specific composer srcripts on Docker Container

| Name      | Command                                                     |
|-----------|-------------------------------------------------------------|
| PHP Stan  | `docker compose run transfer-object-php composer phpstan`   |
| PHPMD     | `docker compose run transfer-object-php composer phpmd`     |
| PHPUnit   | `docker compose run transfer-object-php composer test`      |
| Generator | `docker compose run transfer-object-php composer generator` |
