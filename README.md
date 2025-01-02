![Transfer Object Generator](.github/img/transfer-object-generator.jpg)

[![CI workflow](https://github.com/picamator/transfer-object/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/picamator/transfer-object/actions)
[![License](https://poser.pugx.org/picamator/transfer-object/license)](https://packagist.org/packages/picamator/transfer-object)
[![PHP Version Require](https://poser.pugx.org/picamator/transfer-object/require/php)](https://packagist.org/packages/picamator/transfer-object)
[![Latest Stable Version](https://poser.pugx.org/picamator/transfer-object/v)](https://packagist.org/packages/picamator/transfer-object)

Transfer Object Generator
==========================

Would you like to build Transfer Objects (TO) easily?
You're in the right place!

Build TOs Using an Array as Blueprint
------------------------------------

Imagine you have an array:
```php
$data = [
    'firstName' => 'Jan',
    'lastName' => 'Kowalski',
];
```

then facade method converts array into `YML` file:
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

finally console command generates TO:
```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

Here how it works in action:
 - [Try Sample with Array](/doc/samples/try-definition-generator.php)
 - [Try Sample with YML Definition](/doc/samples/try-transfer-generator.php)

Installation
------------

Simple installation via Composer:

```shell
$ composer require-dev picamator/transfer-object
```

Usage
-----

Transfer Object (TO) generator can be used in two ways:

### I. Via Terminal

Run command bellow, specifying your configuration file:

```shell
$ ./vendor/bin/generate-transfer [-c|--configuration CONFIGURATION]
```

Please check Wiki for more details:
- [Command Configuration](https://github.com/picamator/transfer-object/wiki/Command-Configuration)
- [Definition File](https://github.com/picamator/transfer-object/wiki/Definition-File)

### II. Via Facade Interface

Directly call facade interfaces `TransferGeneratorFacadeInterface`, `DefinitionGeneratorFacadeInterface`.

Please check Wiki for more details:
- [Facade Interfaces](https://github.com/picamator/transfer-object/wiki/Facade-Interfaces)
- [Visualizing Diagrams](https://github.com/picamator/transfer-object/wiki/Visualising-Diagrams)

Acknowledgment
--------------

Many thanks to everyone for you contibution, supports and feadback!
Have fun with using Transfer Object generator!

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
