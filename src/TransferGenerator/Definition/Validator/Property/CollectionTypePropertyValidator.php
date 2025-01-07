<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Validator\NamespaceValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Validator\ValidatorMessageTrait;

readonly class CollectionTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
        private NamespaceValidatorInterface $namespaceValidator,
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
