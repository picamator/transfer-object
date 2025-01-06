<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Validator\NamespaceValidatorTrait;
use Picamator\TransferObject\TransferGenerator\Validator\ValidatorMessageTrait;

readonly class NamespacePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;
    use NamespaceValidatorTrait;

    private const string INVALID_NAMESPACE_ERROR_MESSAGE_TEMPLATE = 'Invalid property namespace "%s".';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->namespace !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $namespace = $propertyTransfer->namespace?->withoutAlias ?: '';
        if ($this->isValidNamespace($namespace)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::INVALID_NAMESPACE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->namespace?->withoutAlias ?: '',
        );
    }
}
