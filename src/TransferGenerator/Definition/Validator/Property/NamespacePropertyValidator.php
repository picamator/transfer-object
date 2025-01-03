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

    private const string NAMESPACE_ALIAS_SEPARATOR = ' as ';

    private const string INVALID_NAMESPACE_ERROR_MESSAGE_TEMPLATE = 'Invalid property namespace "%s".';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->namespace !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $namespace = $this->getNamespaceWithoutAlias($propertyTransfer);
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
            $propertyTransfer->namespace ?: '',
        );
    }

    private function getNamespaceWithoutAlias(DefinitionPropertyTransfer $propertyTransfer): string
    {
        $namespace = $propertyTransfer->namespace ?: '';
        if (!str_contains($namespace, self::NAMESPACE_ALIAS_SEPARATOR)) {
            return $namespace;
        }

        /** @var string $namespace */
        $namespace = strstr($namespace, self::NAMESPACE_ALIAS_SEPARATOR, true);

        return trim($namespace);
    }
}
