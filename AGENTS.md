Purpose
-------

This file is the project index for "agents":

- the modules that generate or use PHP transfer objects
- the IDE plugins that help to develop the project
- the IDE plugins that help to integrate PHP transfer objects into the application

It is intentionally short and only contains agent-specific facts and a concise inventory.
Full how-to and contribution guides are in the canonical destinations:

- README.md
- CONTRIBUTING.md
- CODE_OF_CONDUCT.md
- SECURITY.md
- [WIKI](https://github.com/picamator/transfer-object/wiki)

Installation
------------

```console
$ composer require picamator/transfer-object
```

Directory Structure
-------------------

### Console commands

- `bin`: project's console commands:
  * `transfer-generate`: generate transfer objects from configuration files
  * `transfer-generate-bulk`: generate transfer objects by the list of configuration files
  * `definition-generate`: generate definition files

> Installing the project by composer, the console commands are available in the vendor's bin directory.

### Config

- `config`: transfer object and definition configurations used for definition and transfer generators
- `var/config`: configuration for the project's transfer bulk generator
- `schema`: JSON schemas for definition and transfer configurations

### Examples

- `examples`: samples on how to use `DefinitionGeneratorFacade` and `TransferGeneratorFacade`

### Source

- `src`: code source
- `src/Command`: Symfony console commands to generate definition and transfer object files
- `src/DefinitionGenerator`: definition generator module
- `src/Dependency`: wrapper over third-party dependencies
- `src/Generated`: directory where generated transfer objects are saved
  * should not contain any custom-written code
  * each transfer object generator run overwrites all the files in the directory
  * can be used across modules
- `src/Generated/_tmp`: temporary directory including newly generated transfer objects before they are finally moved to the `src/Generated`
  * in case of an unexpected error, the directory might not be deleted.
- `src/Shared`: contains code shared across modules
  * can be used across modules
- `src/Transfer`: transfer object module
  * can be used across modules
- `src/TransferGenerator`: transfer generator module

### Technical

- `.github`: GitHub CI actions, template and README.md images
- `.xdebug`: Xdebug configuration for [Native Path Mapping](https://xdebug.org/funding/001-native-path-mapping)
- `docker`: [dockerized development environment](https://github.com/picamator/transfer-object/wiki/Development-Environment) configuration with shell helper commands

### Tests

- `tests`: unit and integration PHPUnit tests
- `tests/extension`: PHPUnit extension
- `tests/integration`: integration tests
- `tests/unit`: unit tests

Code Style
----------

- code style should follow [PER Coding Style 3.0](https://www.php-fig.org/per/coding-style/)
- each exception should implement `Picamator\TransferObject\Shared\Exception\TransferExceptionInterface`
- exception messages should follow the same text and structure across all modules

### Classes

- classes should have a strict mode
- classes should be `readonly` when possible
- classes should use Constructor Property Promotion
- class properties should have `private` visibility unless one is a transfer object, or it is necessary for inheritance
- class method's and property's names should be similar across modules
  * **expander** classes should have `public` methods prefixed by `expand`
  * **parser** classes should have `public` methods prefixed by `parse`
  * **builder** classes should have `public` methods prefixed by `create`
  * **reader** classes should have `public` methods prefixed by `get`
  * **render** classes should have `public` methods prefixed by `render`
  * **validator** classes should have `public` methods prefixed by `validate`
  * methods returning `bool` should be prefixed by `is`

### Tests

- test classes should be `final`
- tests should have at least one test group

Module Structure
----------------

#### Facade

- each module should have a facade class with an interface.
- the facade class and interface name should include the module name with `Facade` suffix.
- the facade is used for communication between modules.
- the facade uses factories.
- the facade should not include any business logic.
- the facade `public` methods should have a specification doc-block.

### Factory

- module might contain sub-modules
- each submodule should have at least one factory class
- factory class name should include submodule name with `Factory` suffix
- factory class should be used for class wiring
- factory class should use:
  * `Picamator\TransferObject\Shared\CachedFactoryTrait`
  * `Picamator\TransferObject\Shared\SharedFactoryTrait`
- factory methods should be `public` only when method is used in `Facade` classes, all others should be `protected`

Unit and Integration Tests
--------------------------

- tests should follow a similar structure to the existing ones.
- separate test implementation by comment sections: "Arrange", "Act", "Assert" (optionally with "Expect").
- use `setUp` method to initialize the tested object's stubs and mocks.
- use `PHPUnit` attributes.
- use [PHP generator](https://www.php.net/manual/en/class.generator.php) for the data providers.

How To Install Project
----------------------

The project is installed by running the following command:
```console
docker/sdk install
```

How To Build/Start/Stop Docker Environment
-------------------------------------------

Docker Environment is built by running the following command:
```console
docker/sdk build
```

Docker Environment is started by running the following command:
```console
docker/sdk start
```

Docker Environment is stopped by running the following command:
```console
docker/sdk stop
```

How to Run PHP Script
---------------------

The PHP script runs by command:
```console
docker/sdk cli [path-to-script]
```

For instance, the `./examples/try-transfer-generator.php`:
```console
docker/sdk cli ./examples/try-transfer-generator.php
```

How to Generate Internal Transfer Objects
-----------------------------------------

All project transfer objects (generator's, examples, tests) can be generated with the following command:
```console
docker/sdk to-generate-bulk
```

To generate only generator's transfer objects, please run the following command:
```console
docker/sdk to-generate
```

How to Generate Transfer Objects By Configuration File
------------------------------------------------------

Transfer objects can be generated by a configuration file path, relative from the project's root, by running the following command:
```console
docker/sdk to-generate [path-to-configuration-file]
```

How to Run PHPUnit Tests
------------------------

### How to Run All Tests

All tests can be run with the following command:
```console
docker/sdk phpunit
```

### How to Run Test Group

A test group can be run with the following command:
```console
docker/sdk phpunit-group <group>
```

### How to Run Test Case

A test case can be run with the following command:
```console
docker/sdk phpunit '<test-case-full-qualifided-name>'
```

For instance, the test case `Picamator\Tests\Unit\TransferObject\Command\Helper\InputNormalizerTest`
can be run with the following command:
```console
docker/sdk phpunit 'Picamator\\Tests\\Unit\\TransferObject\\Command\\Helper\\InputNormalizerTest'
```

How to Run PHPStan
------------------

For all project's files, PHPStan can be run with the following command:
```console
docker/sdk phpstan
```

For the specific file:
```console
docker/sdk phpstan <file-path>
```

How to Run PHP CodeSniffer
--------------------------

For all project's files, PHP CodeSniffer can be run with the following command:
```console
docker/sdk phpcs
```

For the specific file:
```console
docker/sdk phpcs <file-path>
```

How to Run PHP Code Beautifier and Fixer
----------------------------------------

For all project's files, PHP Code Beautifier and Fixer can be run with the following command:
```console
docker/sdk phpcbf
```

For the specific file:
```console
docker/sdk phpcbf <file-path>
```

How to Run Composer
-------------------

Composer can be run with the following command:
```console
docker/sdk composer
```

The command supports multiple arguments, for example:
```console
docker/sdk composer install
```
