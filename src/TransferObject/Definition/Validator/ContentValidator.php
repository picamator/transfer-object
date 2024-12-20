<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

use ArrayObject;
use Picamator\TransferObject\Definition\Validator\Property\PropertyValidatorInterface;
use Picamator\TransferObject\Transfer\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Transfer\Generated\DefinitionValidatorTransfer;

readonly class ContentValidator implements ContentValidatorInterface
{
    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
        private PropertyValidatorInterface $propertyValidator,
    ) {
    }

    public function validate(DefinitionContentTransfer $contentTransfer): DefinitionValidatorTransfer
    {
        $errorMessages = $this->handleValidator($contentTransfer);
        $isValid = $errorMessages->count() === 0;

        $validatorTransfer = new DefinitionValidatorTransfer();
        $validatorTransfer->isValid = $isValid;
        $validatorTransfer->errorMessages = $errorMessages;

        return $validatorTransfer;
    }

    /**
     * @return ArrayObject<int,\Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer>
     */
    private function handleValidator(DefinitionContentTransfer $contentTransfer): ArrayObject
    {
        /** @var \ArrayObject<int,\Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer> $errorMessages */
        $errorMessages = new ArrayObject();
        $validatorMessageTransfer = $this->classNameValidator->validate($contentTransfer->className);

        if (!$validatorMessageTransfer->isValid) {
            $errorMessages[] = $validatorMessageTransfer;
        }

        foreach ($contentTransfer->properties as $propertyTransfer) {
            $validatorMessageTransfer = $this->propertyValidator->validate($propertyTransfer);
            if ($validatorMessageTransfer->isValid) {
                continue;
            }

            $errorMessages[] = $validatorMessageTransfer;
        }

        return $errorMessages;
    }
}
