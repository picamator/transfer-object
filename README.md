Transfer Object Generator
==========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/picamator/transfer-object/actions)

Want to build Transfer Objects (TO) effortlessly?
You're in the right place!

Build TOs Using an Array as Blueprint
------------------------------------

Imagine you have an array like this:
```php
$data = [
    'firstName' => 'Jan',
    'lastName' => 'Kowalski',
];
```

TO Generator converts it to Defintion file:
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

Then, console command will generate TO:
```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

Check out how it works:
 - [Try Sample with Array](/doc/samples/try-definition-generator.php)
 - [Try Sample with YML Definition](/doc/samples/try-transfer-generator.php)

Installation
------------

Easily install via Composer:

```bash
composer require-dev picamator/transfer-object
```

Usage
-----

The Transfer Object (TO) generator can be used in two ways:

### I. Via Terminal

Run following command, specifying your configuration file:

```bash
./vendor/bin/generate-transfer [-c|--configuration CONFIGURATION]
```

For more details are in Wiki:
- [Command Configuration](https://github.com/picamator/transfer-object/wiki/Command-Configuration)
- [Definition File](https://github.com/picamator/transfer-object/wiki/Definition-File)

### II. Via Facade Interface

You can also directly call facade interface `TransferGeneratorFacadeInterface`, `DefinitionGeneratorFacadeInterface` methods.

For more details are in Wiki:
- [Facade Interfaces](https://github.com/picamator/transfer-object/wiki/Facade-Interfaces)
- [Visualizing Diagrams](https://github.com/picamator/transfer-object/wiki/Visualising-Diagrams)

Contribution
------------

If you find this project useful, please add a star to the repository. Follow the project to stay updated with all activities.
If you have suggestions for improvements or new features, feel free to create an issue or submit a pull request.
Here is a [Contribution Guide](CONTRIBUTING.md).

Please note that this project is released with a [Contributor Code of Conduct](http://contributor-covenant.org/version/2/1/).
By participating in this project and its community, you agree to abide by those terms.

License
-------

Transfer Object Generator is free and open-source software licensed under the MIT License.
For more details, please see the [LICENSE](LICENSE) file.
