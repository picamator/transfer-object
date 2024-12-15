<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;

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
        $isValid = count($errorMessages) === 0;

        $validatorTransfer = new DefinitionValidatorTransfer();
        $validatorTransfer->isValid = $isValid;
        $validatorTransfer->errorMessages = new ArrayObject($errorMessages);

        return $validatorTransfer;
    }

    /**
     * @return array<string>
     */
    private function handleValidator(DefinitionContentTransfer $contentTransfer): array
    {
        $errorMessages[] = $this->classNameValidator->validate($contentTransfer->className);
        foreach ($contentTransfer->properties as $propertyTransfer) {
            $errorMessages[] = $this->propertyValidator->validate($propertyTransfer);
        }

        return array_filter($errorMessages);
    }
}
