<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\FileReaderProgressTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;

readonly class TransferGeneratorBulkBuilder implements TransferGeneratorBulkBuilderInterface
{
    use ValidatorTrait;

    public function createSuccessBulkTransfer(
        FileReaderProgressTransfer $progressTransfer,
    ): TransferGeneratorBulkTransfer {
        $validatorTransfer = $this->createSuccessValidatorTransfer();

        return $this->createGeneratorBulkTransfer($validatorTransfer, $progressTransfer);
    }

    public function createFailedBulkTransfer(
        string $errorMessage,
        ?FileReaderProgressTransfer $progressTransfer = null,
    ): TransferGeneratorBulkTransfer {
        $validatorTransfer = $this->createErrorValidatorTransfer($errorMessage);

        return $this->createGeneratorBulkTransfer($validatorTransfer, $progressTransfer);
    }

    public function createDefaultProgressTransfer(): FileReaderProgressTransfer
    {
        return new FileReaderProgressTransfer([
            FileReaderProgressTransfer::CONTENT_PROP => '',
            FileReaderProgressTransfer::TOTAL_BYTES_PROP => 0,
            FileReaderProgressTransfer::PROGRESS_BYTES_PROP => 0,
        ]);
    }

    private function createGeneratorBulkTransfer(
        ValidatorTransfer $validatorTransfer,
        ?FileReaderProgressTransfer $progressTransfer = null,
    ): TransferGeneratorBulkTransfer {
        $progressTransfer ??= $this->createDefaultProgressTransfer();

        $bulkTransfer = new TransferGeneratorBulkTransfer();
        $bulkTransfer->progress = $progressTransfer;
        $bulkTransfer->validator = $validatorTransfer;

        return $bulkTransfer;
    }
}
