<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\ErrorMessageTransfer;
use Picamator\TransferObject\Generator\Helper\DefinitionParserTrait;

readonly class DefinitionValidator implements DefinitionValidatorInterface
{
    use DefinitionParserTrait;

    /**
     * @see https://www.php.net/manual/en/language.oop5.basic.php
     * @see https://www.php.net/manual/en/language.variables.basics.php
     */
    private const string VARIABLE_NAME_PATTERN = '#^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$#';

    private const string UNION_TYPE_SEPARATOR = '|';

    private const string PROPERTY_TYPE_ERROR_MESSAGE_TEMPLATE = 'Invalid property "%s" type "%s".';
    private const string PROPERTY_TYPE_UNION_ERROR_MESSAGE_TEMPLATE = 'Union property "%s" type "%s" is not supported.';
    private const string PROPERTY_DEFINITION_ERROR_MESSAGE_TEMPLATE = 'Neither "type" nor "typeCollection" is set on "%s" property definition.';
    private const string PROPERTY_COUNT_ERROR_MESSAGE_TEMPLATE = 'Properties are not set.';
    private const string PROPERTY_NAME_ERROR_MESSAGE_TEMPLATE = 'Invalid property "%s" name.';
    private const string CLASS_NAME_ERROR_MESSAGE_TEMPLATE = 'Invalid class "%s" name.';

    public function validate(array $definition): DefinitionValidatorTransfer
    {
        $errorMessages = $this->handleValidator($definition);

        $errorMessages = array_filter($errorMessages);
        $isValid = count($errorMessages) === 0;

        $validatorTransfer = new DefinitionValidatorTransfer();
        $validatorTransfer->isValid = $isValid;
        $validatorTransfer->errorMessages = new ArrayObject($errorMessages);

        return $validatorTransfer;
    }

    /**
     * @return array
     */
    private function handleValidator(array $definition): array
    {
        $className = $this->getClassName($definition);
        $errorMessages[] = $this->validateClassName($className);

        $properties = $this->getProperties($definition);
        $errorMessages[] = $this->validateProperties($properties);

        foreach ($properties as $propertyName => $propertyDefinition) {
            $errorMessages[] = $this->validatePropertyName($propertyName);
            $errorMessages[] = $this->validatePropertyDefinition($propertyName, $propertyDefinition);
            $errorMessages[] = $this->validatePropertyUnionType($propertyName, $propertyDefinition);
            $errorMessages[] = $this->validatePropertyType($propertyDefinition);
        }

        return array_filter($errorMessages);
    }

    private function validatePropertyType(array $propertyDefinition): ?ErrorMessageTransfer
    {
        if ($this->isPropertyTransfer($propertyDefinition)) {
            return null;
        }

        $type = $this->getPropertyType($propertyDefinition);

        return $this->validateClassName($type);
    }

    private function validatePropertyUnionType(string $propertyName, array $propertyDefinition): ?ErrorMessageTransfer
    {
        $type = $this->getPropertyType($propertyDefinition);
        if (!str_contains($type, static::UNION_TYPE_SEPARATOR)) {
            return null;
        }

        $messageTransfer = new ErrorMessageTransfer();
        $messageTransfer->message = sprintf(static::PROPERTY_TYPE_UNION_ERROR_MESSAGE_TEMPLATE, $propertyName, $type);

        return $messageTransfer;
    }

    private function validatePropertyDefinition(string $propertyName, array $propertyDefinition): ?ErrorMessageTransfer
    {
        $propertyType = $this->getPropertyType($propertyDefinition);
        if ($propertyType !== '') {
            return null;
        }

        $messageTransfer = new ErrorMessageTransfer();
        $messageTransfer->message = sprintf(static::PROPERTY_DEFINITION_ERROR_MESSAGE_TEMPLATE, $propertyName);
        $messageTransfer->context = $propertyDefinition;

        return $messageTransfer;
    }

    private function validateProperties(array $properties): ?ErrorMessageTransfer
    {
        if (count($properties) !== 0) {
            return null;
        }

        $messageTransfer = new ErrorMessageTransfer();
        $messageTransfer->message = static::PROPERTY_COUNT_ERROR_MESSAGE_TEMPLATE;

        return $messageTransfer;
    }

    private function validatePropertyName(string $propertyName): ?ErrorMessageTransfer
    {
        if (preg_match(static::VARIABLE_NAME_PATTERN, $propertyName) >= 1) {
            return null;
        }

        $messageTransfer = new ErrorMessageTransfer();
        $messageTransfer->message = sprintf(static::PROPERTY_NAME_ERROR_MESSAGE_TEMPLATE, $propertyName);

        return $messageTransfer;
    }

    private function validateClassName(string $className): ?ErrorMessageTransfer
    {
        if (preg_match(static::VARIABLE_NAME_PATTERN, $className) >= 1) {
            return null;
        }

        $messageTransfer = new ErrorMessageTransfer();
        $messageTransfer->message = sprintf(static::CLASS_NAME_ERROR_MESSAGE_TEMPLATE, $className);

        return $messageTransfer;
    }
}
