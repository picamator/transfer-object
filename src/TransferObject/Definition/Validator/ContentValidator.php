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
     * @return array<string>
     */
    private function handleValidator(DefinitionContentTransfer $contentTransfer): ArrayObject
    {
        $errorMessages = new ArrayObject();
        $validatorTransfer = $this->classNameValidator->validate($contentTransfer->className);

        if (!$validatorTransfer->isValid) {
            $errorMessages[] = $validatorTransfer->errorMessage;
        }

        foreach ($contentTransfer->properties as $propertyTransfer) {
            $validatorTransfer = $this->propertyValidator->validate($propertyTransfer);
            if ($validatorTransfer->isValid) {
                continue;
            }

            $errorMessages[] = $validatorTransfer->errorMessage;
        }

        return $errorMessages;
    }
}
