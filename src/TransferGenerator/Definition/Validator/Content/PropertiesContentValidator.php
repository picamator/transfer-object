<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

/**
 * phpcs:disable Generic.Files.LineLength
 */
class PropertiesContentValidator implements ContentValidatorInterface
{
    use ValidatorMessageTrait;

    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\TransferGenerator\Definition\Validator\Property\PropertyValidatorInterface> $propertyValidators
     */
    public function __construct(
        private readonly ArrayObject $propertyValidators,
    ) {
    }

    public function validate(DefinitionContentTransfer $contentTransfer): ValidatorMessageTransfer
    {
        foreach ($contentTransfer->properties as $propertyTransfer) {
            $messageTransfer = $this->handlerPropertyValidators($propertyTransfer);
            if ($messageTransfer !== null) {
                return $messageTransfer;
            }
        }

        return $this->createSuccessMessageTransfer();
    }

    private function handlerPropertyValidators(DefinitionPropertyTransfer $propertyTransfer): ?ValidatorMessageTransfer
    {
        foreach ($this->propertyValidators as $validator) {
            if (!$validator->isApplicable($propertyTransfer)) {
                continue;
            }

            $messageTransfer = $validator->validate($propertyTransfer);
            if (!$messageTransfer->isValid) {
                return $messageTransfer;
            }
        }

        return null;
    }
}
