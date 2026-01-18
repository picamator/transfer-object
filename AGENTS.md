Purpose
-------

This file is the project index for "agents":

- the modules that generate or use PHP transfer objects
- the IDE plugins that helps to develop the project
- the IDE plugins that helps to integrate PHP transfer object into application

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

### Endpoints

- `bin`: project's endpoints, include transfer object's console commands

### Config

- `config`: transfer object and definition configurations used for definition and transfer generators
- `var/config`: configuration for the project's transfer bulk generator
- `schema`: JSON schemas for definition and transfer configurations

### Examples

- `examples`: samples how to use `DefinitionGeneratorFacade` and `TransferGeneratorFacade`

### Source

- `src`: code source
- `src/Command`: Symfony console commands to generate definition and transfer object files
- `src/DefinitionGenerator`: definition generator module
- `src/Dependency`: wrapper over 3-part dependencies
- `src/Generated`: directory where generated transfer objects are saved
  * should not contain any custom-written code
  * each transfer object generator run will overwrite all the files in the directory
  * can be used across modules
- `src/Generated/_tmp`: temporary directory includes newly generated transfer objects before they are finally moved to the `src/Generated`
  * in case of an unexpected error, it is possible that directory is not deleted
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

- code style should follow [PSR12](https://www.php-fig.org/psr/psr-12/)
- each exception should implement `Picamator\TransferObject\Shared\Exception\TransferExceptionInterface`
- exception messages should follow the same text style and structure across modules

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

Module Structure
----------------

#### Facade

- each module should have a facade class with an interface
- the facade class and interface name should include the module name with `Facade` suffix
- the facade is used for communication between modules
- the facade used factories
- the facade should not include any business logic
- the facade `public` methods should have specification doc-block

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

- tests should follow a similar structure to the existing ones
- separate test implementation by comment sections: "Arrange", "Act", "Assert" (optionally with "Expect")
- use `setUp` method to initialize the tested object's stubs and mocks
- use `PHPUnit` attributes
- use [PHP generator](https://www.php.net/manual/en/class.generator.php) for the data providers
