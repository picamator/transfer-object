<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Shared\Validator\NamespaceValidatorInterface;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

class CollectionTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    public function __construct(
        private readonly ClassNameValidatorInterface $classNameValidator,
        private readonly NamespaceValidatorInterface $namespaceValidator,
    ) {
    }

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $namespaceTransfer = $propertyTransfer->collectionType?->namespace;
        if ($namespaceTransfer === null) {
            return $this->classNameValidator->validate($propertyTransfer->collectionType?->name);
        }

        return $this->namespaceValidator->validate($namespaceTransfer->withoutAlias);
    }
}
