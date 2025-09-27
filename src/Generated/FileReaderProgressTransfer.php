<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/shared.transfer.yml Definition file path.
 */
final class FileReaderProgressTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CONTENT_INDEX => self::CONTENT,
        self::PROGRESS_BYTES_INDEX => self::PROGRESS_BYTES,
        self::TOTAL_BYTES_INDEX => self::TOTAL_BYTES,
    ];

    // content
    public const string CONTENT = 'content';
    private const int CONTENT_INDEX = 0;

    public string $content {
        get => $this->getData(self::CONTENT_INDEX);
        set => $this->setData(self::CONTENT_INDEX, $value);
    }

    // progressBytes
    public const string PROGRESS_BYTES = 'progressBytes';
    private const int PROGRESS_BYTES_INDEX = 1;

    public int $progressBytes {
        get => $this->getData(self::PROGRESS_BYTES_INDEX);
        set => $this->setData(self::PROGRESS_BYTES_INDEX, $value);
    }

    // totalBytes
    public const string TOTAL_BYTES = 'totalBytes';
    private const int TOTAL_BYTES_INDEX = 2;

    public int $totalBytes {
        get => $this->getData(self::TOTAL_BYTES_INDEX);
        set => $this->setData(self::TOTAL_BYTES_INDEX, $value);
    }
}
