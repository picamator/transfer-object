<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;

/**
 * phpcs:disable Generic.Files.LineLength
 */
readonly class BulkContentValidator implements BulkContentValidatorInterface
{
    use ValidatorTrait;

    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\TransferGenerator\Config\Validator\Content\ContentValidatorInterface> $contentValidators
     */
    public function __construct(
        private ArrayObject $contentValidators,
    ) {
    }

    public function validateContent(ConfigContentTransfer $configContentTransfer): ValidatorTransfer
    {
        $errorMessages = $this->handleContentValidators($configContentTransfer);
        if ($errorMessages->count() === 0) {
            return $this->createSuccessValidatorTransfer();
        }

        $validatorTransfer = $this->createErrorValidatorTransfer();
        $validatorTransfer->errorMessages = $errorMessages;

        return $validatorTransfer;
    }

    /**
     * @return \ArrayObject<int,\Picamator\TransferObject\Generated\ValidatorMessageTransfer>
     */
    private function handleContentValidators(ConfigContentTransfer $configContentTransfer): ArrayObject
    {
        $errorMessages = new ArrayObject();
        foreach ($this->contentValidators as $configValidator) {
            $messageTransfer = $configValidator->validate($configContentTransfer);
            if ($messageTransfer === null || $messageTransfer->isValid) {
                continue;
            }

            $errorMessages->append($messageTransfer);
        }

        return $errorMessages;
    }
}
