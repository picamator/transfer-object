<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Throwable;

class TransferGeneratorBuilder implements TransferGeneratorBuilderInterface
{
    public function createExceptionGeneratorTransfer(
        Throwable $e,
        ?DefinitionTransfer $definitionTransfer = null
    ): TransferGeneratorTransfer {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->className = $definitionTransfer?->content?->className;
        $generatorTransfer->fileName = $definitionTransfer?->fileName;
        $generatorTransfer->validator = $this->createErrorValidatorTransfer($e->getMessage());

        return $generatorTransfer;
    }

    public function createErrorGeneratorTransfer(string $errorMessage): TransferGeneratorTransfer
    {
        $generatorTransfer = new TransferGeneratorTransfer();
        $generatorTransfer->validator = $this->createErrorValidatorTransfer($errorMessage);

        return $generatorTransfer;
    }

    public function createSuccessGeneratorTransfer(): TransferGeneratorTransfer
    {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->validator = new DefinitionValidatorTransfer();
        $generatorTransfer->validator->isValid = true;

        return $generatorTransfer;
    }

    public function createGeneratorTransfer(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer
    {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->className = $definitionTransfer->content->className;
        $generatorTransfer->fileName = $definitionTransfer->fileName;
        $generatorTransfer->validator = $definitionTransfer->validator;

        return $generatorTransfer;
    }

    private function createErrorValidatorTransfer(string $errorMessage): DefinitionValidatorTransfer
    {
        $validatorTransfer = new DefinitionValidatorTransfer();
        $validatorTransfer->isValid = false;
        $validatorTransfer->errorMessages[] = new ValidatorMessageTransfer()
            ->fromArray([
                ValidatorMessageTransfer::IS_VALID => false,
                ValidatorMessageTransfer::ERROR_MESSAGE => $errorMessage,
            ]);

        return $validatorTransfer;
    }
}
