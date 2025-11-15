PHPStorm Junie Guidelines
=========================

Documentation
-------------

- WIKI: https://github.com/picamator/transfer-object/wiki
- Readme: README.md

Directory Structure
--------------------

- `bin`: includes a Symfony single console application
- `config`: transfer object and definition configurations used for definition and transfer generators
- `docker`: dockerized development environment configuration with shell helper commands
- `examples`: samples how to use `DefinitionGeneratorFacade` and `TransferGeneratorFacade`
- `schema`: JSON schemas for definition and transfer configurations
- `src`: code source
- `src/Command`: Symfony console commands to generate definition and transfer object files
- `src/DefinitionGenerator`: Definition generator module
- `src/Dependency`: wrapper over 3-part dependencies
- `src/Generated`: directory where generated transfer objects
  * should not contain any custom-written code
  * each transfer object generator run will overwrite all the files in the directory
- `src/Generated/_tmp`: temporary directory includes newly generated transfer objects before they are finally moved to the `src/Generated`
  * in case of an unexpected error, it is possible that directory is not deleted
- `src/Shared`: contains code shared between modules
  * code in `src/Shared`, `src/Transfer`, and `src/Generated` is allowed to be shared between modules
- `src/Transfer`: transfer object module
- `src/TransferGenerator`: transfer generator module
- `tests`: unit and integration PHPUnit tests
- `tests/extension`: PHPUnit extension
- `tests/integration`: integration tests
- `tests/unit`: unit tests
- `var/config`: configuration for the project's transfer bulk generator

Code Style
----------

- code style follows PSR12
- each exception should implement `TransferExceptionInterface`
- exception messages should follow the same text style and structure across modules
- classes should have a strict mode
- classes should be `readonly` when possible
- classes should use Constructor Property Promotion
- class properties should have `private` visibility unless one is a transfer object, or it is necessary for inheritance
- class method and property names should be similar across modules
* expander classes should have `public` methods prefixed by `expand`
* parser classes should have `public` methods prefixed by `parse`
* builder classes should have `public` methods prefixed by `create`
* reader classes should have `public` methods prefixed by `get`
* render classes should have `public` methods prefixed by `render`
* validator classes should have `public` methods prefixed by `validate`

Module Structure
----------------

#### Facade

- each module should have a facade class with an interface
- the facade class and interface name should include the module name with `Facade` suffix
- the facade is used for communication between modules
- the facade used factories
- the facaded should not include any business logic
- the facade `public` methods should have a dock-block with specification

### Factory

- module might contain sub-modules
- each submodule should have at least one factory class
- factory class name should include submodule name with `Factory` suffix
- factory class should be used for class wiring
- factory class should use `Shared\CachedFactoryTrait.php` and `Shared\CachedFactoryTrait`
- factory method should be `public` only when method is used in Facade, all others should be `protected`

Unit and Integration Tests
--------------------------

- tests should follow a similar structure to the existing ones
- separate by comment sections: Arrange, Expect, Act, Assert
- use `setUp` method to initialize the tested object, its stubs, and mocks
- use PHPUnit attributes
- use PHP generator for the data providers
