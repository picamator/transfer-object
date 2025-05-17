<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;

readonly class TransferGeneratorBuilder implements TransferGeneratorBuilderInterface
{
    use ValidatorTrait;

    public function createErrorWithDefinitionGeneratorTransfer(
        string $errorMessage,
        DefinitionTransfer $definitionTransfer,
    ): TransferGeneratorTransfer {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->className = $definitionTransfer->content->className;
        $generatorTransfer->fileName = $definitionTransfer->fileName;
        $generatorTransfer->validator = $this->createErrorValidatorTransfer($errorMessage);

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

        $generatorTransfer->validator = $this->createSuccessValidatorTransfer();

        return $generatorTransfer;
    }

    public function createGeneratorTransferByDefinition(
        DefinitionTransfer $definitionTransfer
    ): TransferGeneratorTransfer {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->className = $definitionTransfer->content->className;
        $generatorTransfer->fileName = $definitionTransfer->fileName;
        $generatorTransfer->validator = $definitionTransfer->validator;

        return $generatorTransfer;
    }

    public function createGeneratorTransferByConfig(
        string $configPath,
        ConfigTransfer $configTransfer
    ): TransferGeneratorTransfer {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->fileName = $configPath;

        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = $configTransfer->validator->isValid;
        $validatorTransfer->errorMessages = $configTransfer->validator->errorMessages;

        $generatorTransfer->validator = $validatorTransfer;

        return $generatorTransfer;
    }
}
