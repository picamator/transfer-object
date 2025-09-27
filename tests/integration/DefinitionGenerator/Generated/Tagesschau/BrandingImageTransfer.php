<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/tagesschau-api-bund-dev-v2/definition/ardNews.transfer.yml Definition file path.
 */
final class BrandingImageTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::ALTTEXT_INDEX => self::ALTTEXT,
        self::COPYRIGHT_INDEX => self::COPYRIGHT,
        self::IMAGE_VARIANTS_INDEX => self::IMAGE_VARIANTS,
        self::TITLE_INDEX => self::TITLE,
        self::TYPE_INDEX => self::TYPE,
    ];

    // alttext
    public const string ALTTEXT = 'alttext';
    private const int ALTTEXT_INDEX = 0;

    public ?string $alttext {
        get => $this->getData(self::ALTTEXT_INDEX);
        set => $this->setData(self::ALTTEXT_INDEX, $value);
    }

    // copyright
    public const string COPYRIGHT = 'copyright';
    private const int COPYRIGHT_INDEX = 1;

    public ?string $copyright {
        get => $this->getData(self::COPYRIGHT_INDEX);
        set => $this->setData(self::COPYRIGHT_INDEX, $value);
    }

    // imageVariants
    #[PropertyTypeAttribute(ImageVariantsTransfer::class)]
    public const string IMAGE_VARIANTS = 'imageVariants';
    private const int IMAGE_VARIANTS_INDEX = 2;

    public ?ImageVariantsTransfer $imageVariants {
        get => $this->getData(self::IMAGE_VARIANTS_INDEX);
        set => $this->setData(self::IMAGE_VARIANTS_INDEX, $value);
    }

    // title
    public const string TITLE = 'title';
    private const int TITLE_INDEX = 3;

    public ?string $title {
        get => $this->getData(self::TITLE_INDEX);
        set => $this->setData(self::TITLE_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    private const int TYPE_INDEX = 4;

    public ?string $type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }
}
