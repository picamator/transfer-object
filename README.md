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

Convert this array into a definition file that can be used to generate your TO:
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

Then, generate the TO:
```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

Use YML Definitions for Basic TOs
---------------------------------

Prefer using `YML` definitions directly? No problem! Here's a simple example:
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

Why Use Transfer Object Generator?
-----------------------------------

Transfer Object Generator is your modern solution for generating TOs.
Whether you're using `YML` definitions or well-structured arrays as blueprints, this tool has got you covered.

Check out how it works:

 - [Try Sample with Array](/doc/samples/try-defitnition-generator.php).
 - [Try Sample with YML Definition](/doc/samples/try-samples.php) and

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

Run the following command, specifying your configuration file:

```bash
./vendor/bin/generate-transfer [-c|--configuration CONFIGURATION]
```

### Via Facade Interface Methods

You can also directly call the facade interface methods provided by `TransferGeneratorFacadeInterface`, `DefinitionGeneratorFacadeInterface`.

For more details, check out the TO Wiki:
- [Command Configuration](https://github.com/picamator/transfer-object/wiki/Command-Configuration)
- [Definition File](https://github.com/picamator/transfer-object/wiki/Definition-File).

Development Environment
-----------------------

Want to contribute or further develop the project? We've got you covered with a ready-to-use Docker environment.
For more information, check out the [Development Environment](https://github.com/picamator/transfer-object/wiki/Development-Environment) on our Wiki.

Contribution
------------

If you find this project useful, please add a star to the repository. Follow the project to stay updated with all activities.
If you have suggestions for improvements or new features, feel free to create an issue or submit a pull request.
Here is a great [guide to start contributing](https://guides.github.com/activities/contributing-to-open-source/).

Please note that this project is released with a [Contributor Code of Conduct](http://contributor-covenant.org/version/2/1/).
By participating in this project and its community, you agree to abide by those terms.

License
-------

Transfer Object Generator is free and open-source software licensed under the MIT License.
For more details, please see the [LICENSE](LICENSE) file.
