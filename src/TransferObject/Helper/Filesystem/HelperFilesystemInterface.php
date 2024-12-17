<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Filesystem;

use Picamator\TransferObject\Transfer\Generated\HelperFilesystemTransfer;

interface HelperFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     */
    public function appendFile(HelperFilesystemTransfer $filesystemTransfer) : void;

    /**
     * @throws \Picamator\TransferObject\Exception\HelperTransferException
     */
    public function deleteFile(HelperFilesystemTransfer $filesystemTransfer): void;
}
