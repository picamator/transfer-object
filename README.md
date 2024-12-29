Transfer Object Generator
==========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/picamator/transfer-object/actions)

Want to build Transfer Objects (TO) effortlessly without diving deep into configs?
You're in the right place!

Build TOs Using an Array as a Sample
------------------------------------

Imagine you have an array like this:
```php
$data = [
    'firstName' => 'Jan',
    'lastName' => 'Kowalski',
];
```

Convert this array into a definition file with a simple code snippet:
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

Then, generate TO by running console command:
```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

Why Use Transfer Object Generator?
-----------------------------------

1. Transfer Object Generator is your modern solution for generating TOs.
2, Whether you're using `YML` definitions or well-structured arrays as blueprints, this tool has got you covered.

Check out how it works:

 - [Try Sample with Array](/doc/samples/try-defitnition-generator.php).
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

### Via Command

Run following command, specifying your configuration file:

```bash
./vendor/bin/generate-transfer [-c|--configuration CONFIGURATION]
```

### Via Facade Interface Methods

You can also directly call the facade interface methods provided by `TransferGeneratorFacadeInterface`, `DefinitionGeneratorFacadeInterface`.

For more details, check out the TO Wiki:
- [Command Configuration](https://github.com/picamator/transfer-object/wiki/Command-Configuration)
- [Definition File](https://github.com/picamator/transfer-object/wiki/Definition-File).

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
