<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\PropertyValidatorInterface;

readonly class ContentValidator implements ContentValidatorInterface
{
    /**
     * @param \ArrayObject<int,PropertyValidatorInterface> $propertyValidators
     */
    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
        private ArrayObject $propertyValidators,
    ) {
    }

    public function validate(DefinitionContentTransfer $contentTransfer): DefinitionValidatorTransfer
    {
        $errorMessages = $this->handleContentValidator($contentTransfer);
        $isValid = $errorMessages->count() === 0;

        $validatorTransfer = new DefinitionValidatorTransfer();
        $validatorTransfer->isValid = $isValid;
        $validatorTransfer->errorMessages = $errorMessages;

        return $validatorTransfer;
    }

    /**
     * @return ArrayObject<int,\Picamator\TransferObject\Generated\ValidatorMessageTransfer>
     */
    private function handleContentValidator(DefinitionContentTransfer $contentTransfer): ArrayObject
    {
        /** @var \ArrayObject<int,\Picamator\TransferObject\Generated\ValidatorMessageTransfer> $errorMessages */
        $errorMessages = new ArrayObject();
        $messageTransfer = $this->classNameValidator->validate($contentTransfer->className);

        if (!$messageTransfer->isValid) {
            $errorMessages[] = $messageTransfer;
        }

        foreach ($contentTransfer->properties as $propertyTransfer) {
            $messageTransfer = $this->handlerPropertyValidators($propertyTransfer);
            if ($messageTransfer === null) {
                continue;
            }

            $errorMessages[] = $messageTransfer;
        }

        return $errorMessages;
    }

    private function handlerPropertyValidators(DefinitionPropertyTransfer $propertyTransfer): ?ValidatorMessageTransfer
    {
        foreach ($this->propertyValidators as $validator) {
            if (!$validator->isApplicable($propertyTransfer)) {
                continue;
            }

            $messageTransfer = $validator->validate($propertyTransfer);
            if ($messageTransfer->isValid) {
                continue;
            }

            return $messageTransfer;
        }

        return null;
    }
}
