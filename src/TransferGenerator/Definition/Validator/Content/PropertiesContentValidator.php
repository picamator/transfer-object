<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

/**
 * phpcs:disable Generic.Files.LineLength
 */
readonly class PropertiesContentValidator implements ContentValidatorInterface
{
    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\PropertyValidatorInterface> $propertyValidators
     */
    public function __construct(
        private ArrayObject $propertyValidators,
    ) {
    }

    public function validate(DefinitionContentTransfer $contentTransfer): ?ValidatorMessageTransfer
    {
        foreach ($contentTransfer->properties as $propertyTransfer) {
            $messageTransfer = $this->handlerPropertyValidators($propertyTransfer);
            if ($messageTransfer !== null) {
                return $messageTransfer;
            }
        }

        return null;
    }

    private function handlerPropertyValidators(DefinitionPropertyTransfer $propertyTransfer): ?ValidatorMessageTransfer
    {
        foreach ($this->propertyValidators as $validator) {
            if (!$validator->isApplicable($propertyTransfer)) {
                continue;
            }

            $messageTransfer = $validator->validate($propertyTransfer);
            if ($messageTransfer !== null) {
                return $messageTransfer;
            }
        }

        return null;
    }
}
