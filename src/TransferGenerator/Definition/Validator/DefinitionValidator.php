<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\ContentValidatorInterface;

readonly class DefinitionValidator implements DefinitionValidatorInterface
{
    /**
     * @param \ArrayObject<int,ContentValidatorInterface> $contentValidators
     */
    public function __construct(
        private ArrayObject $contentValidators,
    ) {
    }

    public function validate(DefinitionContentTransfer $contentTransfer): DefinitionValidatorTransfer
    {
        $errorMessages = $this->handleContentValidators($contentTransfer);
        $isValid = $errorMessages->count() === 0;

        $validatorTransfer = new DefinitionValidatorTransfer();
        $validatorTransfer->isValid = $isValid;
        $validatorTransfer->errorMessages = $errorMessages;

        return $validatorTransfer;
    }

    /**
     * @return \ArrayObject<int,\Picamator\TransferObject\Generated\ValidatorMessageTransfer>
     */
    private function handleContentValidators(DefinitionContentTransfer $contentTransfer): ArrayObject
    {
        /** @var \ArrayObject<int,\Picamator\TransferObject\Generated\ValidatorMessageTransfer> $errorMessages */
        $errorMessages = new ArrayObject();
        foreach ($this->contentValidators as $validator) {
            $messageTransfer = $validator->validate($contentTransfer);
            if ($messageTransfer->isValid) {
                continue;
            }

            $errorMessages[] = $messageTransfer;
        }

        return $errorMessages;
    }
}