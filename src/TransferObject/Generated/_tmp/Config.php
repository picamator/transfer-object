<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class ConfigTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CLASS_NAMESPACE => self::CLASS_NAMESPACE_DATA_NAME,
        self::DEFINITION_PATH => self::DEFINITION_PATH_DATA_NAME,
        self::GENERATED_PATH => self::GENERATED_PATH_DATA_NAME,
    ];

    // classNamespace
    public const string CLASS_NAMESPACE = 'classNamespace';
    protected const string CLASS_NAMESPACE_DATA_NAME = 'CLASS_NAMESPACE';
    protected const int CLASS_NAMESPACE_DATA_INDEX = 0;
    
    public ?string $classNamespace {
        get => $this->data[self::CLASS_NAMESPACE_DATA_INDEX];
        set => $this->data[self::CLASS_NAMESPACE_DATA_INDEX] = $value;
    }

    // definitionPath
    #[PropertyTypeAttribute(DefinitionPathTransfer::class)]
    public const string DEFINITION_PATH = 'definitionPath';
    protected const string DEFINITION_PATH_DATA_NAME = 'DEFINITION_PATH';
    protected const int DEFINITION_PATH_DATA_INDEX = 1;
    
    public ?DefinitionPathTransfer $definitionPath {
        get => $this->data[self::DEFINITION_PATH_DATA_INDEX];
        set => $this->data[self::DEFINITION_PATH_DATA_INDEX] = $value;
    }

    // generatedPath
    #[PropertyTypeAttribute(GeneratedPathTransfer::class)]
    public const string GENERATED_PATH = 'generatedPath';
    protected const string GENERATED_PATH_DATA_NAME = 'GENERATED_PATH';
    protected const int GENERATED_PATH_DATA_INDEX = 2;
    
    public ?GeneratedPathTransfer $generatedPath {
        get => $this->data[self::GENERATED_PATH_DATA_INDEX];
        set => $this->data[self::GENERATED_PATH_DATA_INDEX] = $value;
    }
}
