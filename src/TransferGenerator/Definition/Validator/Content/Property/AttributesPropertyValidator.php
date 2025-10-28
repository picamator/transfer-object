<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use Attribute;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;
use ReflectionAttribute;
use ReflectionClass;

readonly class AttributesPropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ATTRIBUTE_NOT_FOUND_ERROR_MESSAGE_TEMPLATE = 'Attribute "%s" not found.';
    private const string INVALID_ATTRIBUTE_ERROR_MESSAGE_TEMPLATE = 'Class "%s" is not an attribute.';
    private const string INVALID_ATTRIBUTE_TARGET_ERROR_MESSAGE_TEMPLATE
        = 'Attribute "%s" is not allowed to target on properties.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->attributes->count() > 0;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ?ValidatorMessageTransfer
    {
        foreach ($propertyTransfer->attributes as $attributeTransfer) {
            $validatorMessageTransfer = $this->validateAttribute($attributeTransfer->namespace->fullName);

            if ($validatorMessageTransfer !== null) {
                return $validatorMessageTransfer;
            }
        }

        return null;
    }

    private function validateAttribute(string $name): ?ValidatorMessageTransfer
    {
        if (!class_exists($name)) {
            return $this->createErrorMessageTransfer(
                sprintf(self::ATTRIBUTE_NOT_FOUND_ERROR_MESSAGE_TEMPLATE, $name),
            );
        }

        $reflection = new ReflectionClass($name);
        $attributes = $reflection->getAttributes(Attribute::class);

        if ($attributes === []) {
            return $this->createErrorMessageTransfer(
                sprintf(self::INVALID_ATTRIBUTE_ERROR_MESSAGE_TEMPLATE, $name),
            );
        }

        $isTargetProperty = array_any($attributes, $this->isTargetProperty(...));

        if (!$isTargetProperty) {
            return $this->createErrorMessageTransfer(
                sprintf(self::INVALID_ATTRIBUTE_TARGET_ERROR_MESSAGE_TEMPLATE, $name),
            );
        }

        return null;
    }

    /**
     * @param ReflectionAttribute<\Attribute> $attribute
     */
    private function isTargetProperty(ReflectionAttribute $attribute): bool
    {
        return (bool)($attribute->newInstance()->flags & Attribute::TARGET_PROPERTY);
    }
}
