Transfer Object Generator
==========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Transfer Object Generator builds Transfer Objects (TOs) based on `YML` definitions.

For instance defintion bellow
```yml
Customer:
  firstName:
    type: string
  lastName:
    type: string
```

generates TO
```php
$customerTransfer = new CustomerTransfer();
$customerTransfer->firstName = 'Jan';
$customerTransfer->lastName = 'Kowalski';
```

Moreover any array, can be used as a blueprint to create definition file.
```php
$data = [
    'firstName' => 'Jan',
    'lastName' => 'Kowalski',
];
```

[Try Samples](/doc/Samples/try-samples.php) to see how TO works.

Installation
------------

```bash
composer require-dev picamator/transfer-object
```

Usage
-----

### Terminal
After installation TO generator command `generate-transfer` is available on `./vendor/bin` directory.

```bash
./vendor/bin/generate-transfer -c [path to configuration file]
```

### Helper (experimental)
Helper class allows to generate TO definitions based on data e.g. API response, ORM entity etc.

[Try Helper](/doc/Helper/try-helper.php) to generate TO definitions and the second part [Try Helper Part 2](/doc/Helper/try-helper-part-2.php)
to check newly generated TOs.

_Note_: Experimental feature works only for the well structured data, resolving `null` type as a `string`.

Configuration File
------------------
Details about configuration file can be found on [Command Configuration Wiki](https://github.com/picamator/transfer-object/wiki/Command-Configuration),
or on [Configuration Sample](/doc/Samples/config/generator.yml).

Definition
----------
Details about configuration file can be found on [Definition Wiki](https://github.com/picamator/transfer-object/wiki/Definition)
or on [Definition Sample](/doc/Samples/config/definition).

Development Environment
-----------------------
Development environment includes Docker, CaptainHooks, UnitTests etc.
More information can be found on the [Development Environment Wiki](https://github.com/picamator/transfer-object/wiki/Development-Environment).

Contribution
------------
If you find this project worth to use please add a star. Follow changes to see all activities.
And if you see room for improvement, proposals please feel free to create an issue or send pull request.
Here is a great [guide to start contributing](https://guides.github.com/activities/contributing-to-open-source/).

Please note that this project is released with a [Contributor Code of Conduct](http://contributor-covenant.org/version/1/4/).
By participating in this project and its community you agree to abide by those terms.

License
-------
Transfer Object Generator is licensed under the MIT License. Please see the [LICENSE](LICENSE) file for details.
