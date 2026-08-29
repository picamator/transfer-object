Purpose
-------

This file is for AI Agents.
It is intentionally short and only contains agent-specific facts and a concise inventory.

Full how-to and contribution guides are in the canonical destinations:

- [README.md](README.md)
- [CONTRIBUTING.md](CONTRIBUTING.md)
- [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)
- [SECURITY.md](SECURITY.md)
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
  * `transfer-generate`: generates transfer objects from a single configuration file.
  * `transfer-generate-bulk`: generates transfer objects from a list of configuration files.
  * `definition-generate`: generates definition files from JSON blueprints.

### Config

- `config`: transfer object and definition configurations used for definition and transfer generators.
- `var/config`: configuration for the project's transfer bulk generator.
- `schema`: JSON schemas for definition and transfer configurations.

### Examples

- `examples`: how to use `DefinitionGeneratorFacade` and `TransferGeneratorFacade` samples.

### Source

- `src`: code source.
- `src/Command`: Symfony console commands to generate definition and transfer object files.
- `src/DefinitionGenerator`: definition generator module.
- `src/Dependency`: wrapper over third-party dependencies.
- `src/Generated`: directory where generated transfer objects are saved.
  * Should not contain any custom-written code.
- `src/Generated/_tmp`: temporary directory to hold the transfer object generator's process directories.
- `src/Generated/_tmp/{uuid}`: transfer object generator's process directory named by UUID.
  The directory is created before the process starts and holds new transfer objects:
  * only when the process is finished successfully, the transfer objects are moved to the `Generated` directory
  * the directory is deleted after the process is finished
  * in case of an unexpected error, the directory might not be deleted.
- `src/Generated/_tmp/{uuid}/{hash}.transfer.hash.csv`: hash file.
  Each hash file line contains a comma-separated transfer object class name and transfer object content hash.
- `src/Generated/{hash}.transfer.hash.csv`: hash file from previous transfer object generation run.
  It is used to check for transfer object content changes and if some transfer objects should be deleted.
  The hash file can be deleted. In that case, all transfer objects will be generated with the new hash file.
- `src/Generated/transfer.lock`: lock file used to prevent multiple processes from writing to the `Generated` directory at the same time.
- `src/Shared`: contains code shared across modules.
- `src/Transfer`: transfer object module.
- `src/TransferGenerator`: transfer generator module.

### Technical

- `.github`: GitHub CI actions, template, and README.md images.
- `.xdebug`: Xdebug configuration for [Native Path Mapping](https://xdebug.org/funding/001-native-path-mapping).
- `docker`: [dockerized development environment](https://github.com/picamator/transfer-object/wiki/Development-Environment) configuration with shell helper commands.

### Tests

- `tests`: unit and integration PHPUnit tests.
- `tests/extension`: PHPUnit extension.
- `tests/integration`: integration tests.
- `tests/unit`: unit tests.

Code Style
----------

- Code style should follow [PER Coding Style 3.0](https://www.php-fig.org/per/coding-style/).
- Each exception should implement `Picamator\TransferObject\Shared\Exception\TransferExceptionInterface`.
- Exception messages should follow the same text and structure across all modules.

### Classes

- Classes should have a strict mode.
- Classes should be `readonly` when possible.
- Classes should use Constructor Property Promotion.
- Class properties should have `private` visibility unless one is a transfer object, or it is necessary for inheritance.
- Class methods and property names should be similar across modules:
  * **expander** classes should have `public` methods prefixed by `expand`
  * **parser** classes should have `public` methods prefixed by `parse`
  * **builder** classes should have `public` methods prefixed by `create`
  * **reader** classes should have `public` methods prefixed by `get` or `read`
  * **render** classes should have `public` methods prefixed by `render`
  * **validator** classes should have `public` methods prefixed by `validate`
  * methods returning `bool` should be prefixed by `is`.

### Tests

- Test classes should be `final`.
- Tests should have at least one test group.

Module Structure
----------------

#### Facade

- Each module, except `src/Transfer`, should have a facade class with an interface.
- The facade class and interface name should include the module name with `Facade` suffix.
- The facade is used for communication between modules.
- The facade uses factories.
- The facade should not include any business logic.
- The facade `public` methods should have a specification doc-block.

### Factory

- Module might contain submodules.
- Each submodule should have at least one factory class.
- A factory class name should include the submodule name with the `Factory` suffix.
- A factory class should be used for class wiring.
- A factory class should use:
  * `Picamator\TransferObject\Shared\CachedFactoryTrait`
  * `Picamator\TransferObject\Shared\SharedFactoryTrait`
- Factory methods should be `public` only when the method is used in `Facade` classes; all others should be `protected`.

Unit and Integration Tests
--------------------------

- Tests should follow a similar structure to the existing ones.
- Separate test implementation by comment sections: "Arrange", "Act", "Assert" (optionally with "Expect").
- Use `setUp` method to initialize the tested object's stubs and mocks.
- Use `PHPUnit` attributes.
- Use [PHP generator](https://www.php.net/manual/en/class.generator.php) for the data providers.

How to Install Project
----------------------

The project is installed by the command:
```console
docker/sdk install
```

How to Build/Start/Stop Docker Environment
-------------------------------------------

The Docker environment is built by the command:
```console
docker/sdk build
```

The Docker environment is started by the command:

```console
docker/sdk start
```

The Docker environment is stopped by the command:
```console
docker/sdk stop
```

How to Run PHP File
--------------------

A PHP file is run by the command:
```console
docker/sdk cli [path-to-the-file]
```

For instance, for the PHP file `./examples/try-transfer-generator.php`:
```console
docker/sdk cli ./examples/try-transfer-generator.php
```

How to Generate Internal Transfer Objects
-----------------------------------------

To generate all project transfer objects (generators, examples, tests), run the command:
```console
docker/sdk to-generate-bulk
```

To generate only the generator's transfer objects, run the command:
```console
docker/sdk to-generate
```

How to Generate Transfer Objects by Configuration File
------------------------------------------------------

To generate transfer objects by a configuration file path, relative to the project's root, run the command:
```console
docker/sdk to-generate [path-to-configuration-file]
```

How to Generate Definition Files
--------------------------------

To generate definition files from JSON blueprints, run the command:
```console
docker/sdk df-generate
```

How to Run PHPUnit Tests
------------------------

### How to Run All Tests

All tests are run by the command:
```console
docker/sdk phpunit
```

### How to Run a Test Group

A test group is run by the command:
```console
docker/sdk phpunit-group <group>
```

### How to Run a Test Case

A test case is run by the command:
```console
docker/sdk phpunit '<test-case-full-qualified-name>'
```

For instance, the test case `Picamator\Tests\Unit\TransferObject\Command\Helper\InputNormalizerTest`
is run by the command:
```console
docker/sdk phpunit 'Picamator\\Tests\\Unit\\TransferObject\\Command\\Helper\\InputNormalizerTest'
```

How to Run PHPStan
------------------

For all project files, PHPStan is run by the command:
```console
docker/sdk phpstan
```

For a specific file, PHPStan is run by the command:
```console
docker/sdk phpstan <file-path>
```

How to Run PHP CodeSniffer
--------------------------

For all project files, PHP CodeSniffer is run by the command:
```console
docker/sdk phpcs
```

For a specific file, PHP CodeSniffer is run by the command:
```console
docker/sdk phpcs <file-path>
```

How to Run PHP Code Beautifier and Fixer
----------------------------------------

For all project files, PHP Code Beautifier and Fixer are run by the command:
```console
docker/sdk phpcbf
```

For a specific file, PHP Code Beautifier and Fixer are run by the command:
```console
docker/sdk phpcbf <file-path>
```

How to Run Composer
-------------------

Composer is run by the command:
```console
docker/sdk composer
```

The command supports multiple arguments, for example:
```console
docker/sdk composer install
```
