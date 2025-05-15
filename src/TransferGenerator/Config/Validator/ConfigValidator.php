<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\Shared\Validator\PathExistValidatorInterface;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\ConfigContentValidatorInterface;

readonly class ConfigValidator implements ConfigValidatorInterface
{
    use ValidatorMessageTrait;

    /**
     * @param \ArrayObject<int,ConfigContentValidatorInterface> $contentValidators
     */
    public function __construct(
        private PathExistValidatorInterface $pathValidator,
        private ArrayObject $contentValidators,
    ) {
    }

    public function validateFile(string $filePath): ValidatorTransfer
    {
        $messageTransfer = $this->pathValidator->validate($filePath);

        if ($messageTransfer->isValid) {
            return $this->createSuccessValidatorTransfer();
        }

        $validatorTransfer = $this->createErrorValidatorTransfer();
        $validatorTransfer->errorMessages[] = $messageTransfer;

        return $validatorTransfer;
    }

    public function validateContent(ConfigContentTransfer $configContentTransfer): ValidatorTransfer
    {
        /** @var \ArrayObject<int,\Picamator\TransferObject\Generated\ValidatorMessageTransfer> $errorMessages */
        $errorMessages = new ArrayObject();
        foreach ($this->contentValidators as $configValidator) {
            $messageTransfer = $configValidator->validate($configContentTransfer);
            if ($messageTransfer->isValid) {
                continue;
            }

            $errorMessages[] = $messageTransfer;
        }

        if ($errorMessages->count() === 0) {
            return $this->createSuccessValidatorTransfer();
        }

        $validatorTransfer = $this->createErrorValidatorTransfer();
        $validatorTransfer->errorMessages = $errorMessages;

        return $validatorTransfer;
    }

    private function createErrorValidatorTransfer(): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = false;

        return $validatorTransfer;
    }

    private function createSuccessValidatorTransfer(): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = true;

        return $validatorTransfer;
    }
}
