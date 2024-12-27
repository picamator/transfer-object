Transfer Object Generator
==========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)

The Transfer Object (TO) Generator builds Transfer Objects based on `YML` definitions.

For example, the following definition:

```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

generates the following TO:

```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

To see how TO works, please open [try-samples.php](/doc/samples/try-samples.php).

A definition file can also be generated using a well-structured array:

```php
$data = [
    'firstName' => 'Jan',
    'lastName' => 'Kowalski',
];
```

To see how the Definition Generator works, open [try-definition-generator.php](/doc/samples/try-defitnition-generator.php).

Installation
------------

Install the package using Composer:

```bash
composer require-dev picamator/transfer-object
```

Usage
-----

### Terminal

After installation, the TO generator command `generate-transfer` is available in the `./vendor/bin` directory.

```bash
./vendor/bin/generate-transfer [-c|--configuration CONFIGURATION]
```

Configuration File
------------------

Details about the configuration file can be found on the [Command Configuration Wiki](https://github.com/picamator/transfer-object/wiki/Command-Configuration).
See example configuration file [generator.config.yml](/doc/samples/config/generator.config.yml).

Definition Files
----------------

Details about the definition files can be found on the [Definition Wiki](https://github.com/picamator/transfer-object/wiki/Definition-File).
See example definition files [here](/doc/samples/config/definition).

Development Environment
-----------------------

The development environment includes Docker, CaptainHook, UnitTests, etc.
More information can be found on the [Development Environment Wiki](https://github.com/picamator/transfer-object/wiki/Development-Environment).

Contribution
------------

If you find this project useful, please add a star to the repository. Follow the project to stay updated with all activities. If you have suggestions for improvements or new features, feel free to create an issue or submit a pull request.
Here is a great [guide to start contributing](https://guides.github.com/activities/contributing-to-open-source/).

Please note that this project is released with a [Contributor Code of Conduct](http://contributor-covenant.org/version/2/1/).
By participating in this project and its community, you agree to abide by those terms.

License
-------

Transfer Object Generator is licensed under the MIT License. Please see the [LICENSE](LICENSE) file for details.
