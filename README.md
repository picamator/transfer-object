Transfer Object Generator
==========================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Transfer Object (or further TO) Generator creates TO with:

- PHP 8.4 property Hooks
- FixedArray as a main storage
- Transformation from and to Array as well as between TOs
- Implementation `IteratorAggregate`, `JsonSerializable`, `Serializable`, `Countable` interfaces

TO Generator includes console commands:

- Build TOs based on `YML` defintions
- Build `YML` defintions based on `JSON`


Definition
----------
TO Defintion is an `YML` file, that can contains one or many defitiotions.

 - Each root level is a new TO name
 - Second level is a property name
 - Third level is a property type supporting only tww keys `type` and `collectionType`

For example, defintion for `CustomerTransfer` with two `string` properties

```yml
Customer:
    firstName:
        type: string
    lastName:
        type: string
```

### Defintion Types
@todo

Generated Object
----------------
@todo
