<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\FileReaderProgressTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;

readonly class TransferGeneratorBulkBuilder implements TransferGeneratorBulkBuilderInterface
{
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
        $validatorTransfer = $this->createFailedValidatorTransfer($errorMessage);

        return $this->createGeneratorBulkTransfer($validatorTransfer, $progressTransfer);
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

    private function createFailedValidatorTransfer(string $errorMessage): ValidatorTransfer
    {
        return new ValidatorTransfer([
            ValidatorTransfer::IS_VALID => false,
            ValidatorTransfer::ERROR_MESSAGES => [
                [
                    ValidatorMessageTransfer::IS_VALID => false,
                    ValidatorMessageTransfer::ERROR_MESSAGE => $errorMessage,
                ]
            ]
        ]);
    }

    private function createSuccessValidatorTransfer(): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = true;

        return $validatorTransfer;
    }

    private function createDefaultProgressTransfer(): FileReaderProgressTransfer
    {
        return new FileReaderProgressTransfer([
            FileReaderProgressTransfer::CONTENT => '',
            FileReaderProgressTransfer::TOTAL_BYTES => 0,
            FileReaderProgressTransfer::PROGRESS_BYTES => 0,
        ]);
    }
}
