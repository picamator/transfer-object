<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

use ArrayObject;
use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class ContentValidator implements ContentValidatorInterface
{
    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\Definition\Validator\Property\PropertyValidatorInterface> $propertyValidators
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
     * @return ArrayObject<int,\Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer>
     */
    private function handleContentValidator(DefinitionContentTransfer $contentTransfer): ArrayObject
    {
        /** @var \ArrayObject<int,\Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer> $errorMessages */
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
