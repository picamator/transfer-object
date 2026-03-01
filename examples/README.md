Examples
========

To run examples, please install Docker SDK.

```console
$ docker/sdk install
```
For more details, please visit [Development Environment](https://github.com/picamator/transfer-object/wiki/Development-Environment).

Transfer Object Generator
-------------------------

The following command will generate the transfer objects:

```console
$ docker/sdk to-generate examples/config/transfer-generator/generator.config.yml
```

Alternatively, transfer objects can be generated using the `TransferGeneratorFacade`,
see [try-transfer-generator.php](try-transfer-generator.php), and [try-advanced-transfer-generator.php](try-advanced-transfer-generator.php).

The following commands will run the samples:

```console
$ docker/sdk cli examples/try-transfer-generator.php
```

and

```console
$ docker/sdk cli examples/try-advanced-transfer-generator.php
```

Definition Generator
---------------------

To generate the definition files, based on [product.json](data/product.json),
the following command can be used:

```console
$ docker/sdk df-generate
```

Please answer the input questions as:

1. Definition directory path: `examples/config/definition-generator/definition`
2. Transfer Object class name: `Product`
3. JSON local path or url: `examples/data/product.json`

The following commands will generate transfer objects:

```console
$ docker/sdk to-generate examples/config/definition-generator/generator.config.yml
```

Alternatively, definition files can be generated using the `DefinitionGeneratorFacade`,
see [try-definition-generator.php](try-definition-generator.php).

The following commands will run the sample:

```console
$ docker/sdk cli examples/try-definition-generator.php
```
