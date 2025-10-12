<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Shared\Validator\NamespaceValidatorInterface;

readonly class TransferTypePropertyValidator implements PropertyValidatorInterface
{
    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
        private NamespaceValidatorInterface $namespaceValidator,
    ) {
    }

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->transferType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ?ValidatorMessageTransfer
    {
        $namespaceTransfer = $propertyTransfer->transferType?->namespace;
        if ($namespaceTransfer === null) {
            return $this->classNameValidator->validate($propertyTransfer->transferType?->name);
        }

        return $this->namespaceValidator->validate($namespaceTransfer->withoutAlias);
    }
}
