<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ConfigValidatorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\PathValidatorInterface;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\TransferGenerator\Config\Validator\Content\ConfigContentValidatorInterface;

readonly class ConfigValidator implements ConfigValidatorInterface
{
    use ValidatorMessageTrait;

    /**
     * @param \ArrayObject<int,ConfigContentValidatorInterface> $contentValidators
     */
    public function __construct(
        private PathValidatorInterface $pathValidator,
        private ArrayObject $contentValidators,
    ) {
    }

    public function validateFile(string $filePath): ConfigValidatorTransfer
    {
        $messageTransfer = $this->pathValidator->validate($filePath);

        return $this->createValidatorTransfer($messageTransfer);
    }

    public function validateContent(ConfigContentTransfer $configContentTransfer): ConfigValidatorTransfer
    {
        foreach ($this->contentValidators as $configValidator) {
            $messageTransfer = $configValidator->validate($configContentTransfer);
            if ($messageTransfer->isValid) {
                continue;
            }

            return $this->createValidatorTransfer($messageTransfer);
        }

        $messageTransfer ??= $this->createSuccessMessageTransfer();

        return $this->createValidatorTransfer($messageTransfer);
    }

    private function createValidatorTransfer(ValidatorMessageTransfer $messageTransfer): ConfigValidatorTransfer
    {
        $validatorTransfer = new ConfigValidatorTransfer();
        $validatorTransfer->isValid = $messageTransfer->isValid;

        if (!$messageTransfer->isValid) {
            $validatorTransfer->errorMessages[] = $messageTransfer;
        }

        return $validatorTransfer;
    }
}
