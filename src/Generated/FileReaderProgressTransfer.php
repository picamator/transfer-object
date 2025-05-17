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
        self::CONTENT => self::CONTENT_DATA_NAME,
        self::PROGRESS_BYTES => self::PROGRESS_BYTES_DATA_NAME,
        self::TOTAL_BYTES => self::TOTAL_BYTES_DATA_NAME,
    ];

    // content
    public const string CONTENT = 'content';
    protected const string CONTENT_DATA_NAME = 'CONTENT';
    protected const int CONTENT_DATA_INDEX = 0;

    public string $content {
        get => $this->getData(self::CONTENT_DATA_INDEX);
        set => $this->setData(self::CONTENT_DATA_INDEX, $value);
    }

    // progressBytes
    public const string PROGRESS_BYTES = 'progressBytes';
    protected const string PROGRESS_BYTES_DATA_NAME = 'PROGRESS_BYTES';
    protected const int PROGRESS_BYTES_DATA_INDEX = 1;

    public int $progressBytes {
        get => $this->getData(self::PROGRESS_BYTES_DATA_INDEX);
        set => $this->setData(self::PROGRESS_BYTES_DATA_INDEX, $value);
    }

    // totalBytes
    public const string TOTAL_BYTES = 'totalBytes';
    protected const string TOTAL_BYTES_DATA_NAME = 'TOTAL_BYTES';
    protected const int TOTAL_BYTES_DATA_INDEX = 2;

    public int $totalBytes {
        get => $this->getData(self::TOTAL_BYTES_DATA_INDEX);
        set => $this->setData(self::TOTAL_BYTES_DATA_INDEX, $value);
    }
}
