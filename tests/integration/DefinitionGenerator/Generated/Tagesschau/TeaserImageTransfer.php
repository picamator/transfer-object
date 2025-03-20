<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class TeaserImageTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::ALTTEXT => self::ALTTEXT_DATA_NAME,
        self::IMAGE_VARIANTS => self::IMAGE_VARIANTS_DATA_NAME,
        self::TYPE => self::TYPE_DATA_NAME,
    ];

    // alttext
    public const string ALTTEXT = 'alttext';
    protected const string ALTTEXT_DATA_NAME = 'ALTTEXT';
    protected const int ALTTEXT_DATA_INDEX = 0;

    public ?string $alttext {
        get => $this->getData(self::ALTTEXT_DATA_INDEX);
        set => $this->setData(self::ALTTEXT_DATA_INDEX, $value);
    }

    // imageVariants
    #[ArrayPropertyTypeAttribute]
    public const string IMAGE_VARIANTS = 'imageVariants';
    protected const string IMAGE_VARIANTS_DATA_NAME = 'IMAGE_VARIANTS';
    protected const int IMAGE_VARIANTS_DATA_INDEX = 1;

    /** @var array<int|string,mixed> */
    public array $imageVariants {
        get => $this->getRequiredData(self::IMAGE_VARIANTS_DATA_INDEX);
        set => $this->setData(self::IMAGE_VARIANTS_DATA_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    protected const string TYPE_DATA_NAME = 'TYPE';
    protected const int TYPE_DATA_INDEX = 2;

    public ?string $type {
        get => $this->getData(self::TYPE_DATA_INDEX);
        set => $this->setData(self::TYPE_DATA_INDEX, $value);
    }
}
