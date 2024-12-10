<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Reader;

use Picamator\TransferObject\Generator\Enum\ArrayObjectEnum;
use Picamator\TransferObject\Generator\Enum\CollectionPropertyTypeEnum;
use Picamator\TransferObject\Generator\Enum\PropertyTypeEnum;
use Picamator\TransferObject\Generator\Enum\TransferEnum;
use Picamator\TransferObject\Generator\Helper\DefinitionParserTrait;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generator\Validator\DefinitionValidatorInterface;

readonly class DefinitionReaderBuilder implements DefinitionReaderBuilderInterface
{
    use DefinitionParserTrait;

    public function __construct(
        private DefinitionValidatorInterface $validator,
        private ConfigTransfer $configTransfer,
    ) {
    }

    public function createDefinitionTransfer(array $definition): DefinitionTransfer
    {
        $validatorTransfer = $this->validator->validate($definition);

        $definitionTransfer = new DefinitionTransfer();
        $definitionTransfer->validator = $validatorTransfer;

        if (!$validatorTransfer->isValid) {
            return $definitionTransfer;
        }

        $definitionTransfer->template = $this->createTemplateTransfer($definition);

        return $definitionTransfer;
    }

    private function createTemplateTransfer(array $definition): TemplateTransfer
    {
        $templateTransfer = new TemplateTransfer();
        $templateTransfer->classNamespace = $this->configTransfer->classNamespace;
        $templateTransfer->className = $this->getClassName($definition);

        $imports = [TransferEnum::ABSTRACT_CLASS_NAME->value];
        $properties = [];
        $metaConstants = [];
        $attributes = [];
        $dockBlocks = [];

        foreach ($this->getProperties($definition) as $propertyName => $propertyDefinition) {
            $metaConstants[$this->getMetaConstant($propertyName)] = $propertyName;

            $propertyType = $this->getPropertyType($propertyDefinition);
            if ($this->isPropertyCollection($propertyDefinition)) {
                $imports[] = ArrayObjectEnum::CLASS_NAME->value;
                $imports[] = CollectionPropertyTypeEnum::CLASS_NAME->value;

                $transferName = $this->getTransferName($propertyType);

                $properties[$propertyName] = ArrayObjectEnum::CLASS_NAME->value;
                $attributes[$propertyName] = sprintf(CollectionPropertyTypeEnum::ATTRIBUTE_TEMPLATE->value, $transferName);
                $dockBlocks[$propertyName] = sprintf(CollectionPropertyTypeEnum::DOCK_BLOCK_TEMPLATE->value, $transferName);

                continue;
            }

            if ($this->isPropertyTransfer($propertyDefinition)) {
                $imports[] = PropertyTypeEnum::CLASS_NAME->value;

                $transferName = $this->getTransferName($propertyType);
                $properties[$propertyName] = $transferName;
                $attributes[$propertyName] = sprintf(PropertyTypeEnum::ATTRIBUTE_TEMPLATE->value, $transferName);

                continue;
            }

            $properties[$propertyName] = $propertyType;
        }


        $templateTransfer->imports = array_unique($imports);
        $templateTransfer->properties = $properties;
        $templateTransfer->propertiesCount = count($properties);
        $templateTransfer->metaConstants = $metaConstants;
        $templateTransfer->attributes = $attributes;
        $templateTransfer->dockBlocks = $dockBlocks;

        $this->sortTemplateTransfer($templateTransfer);

        return $templateTransfer;
    }

    private function sortTemplateTransfer(TemplateTransfer $templateTransfer): void
    {
        foreach ($templateTransfer as $key => $value) {
            if (!is_array($value)) {
                continue;
            }
            natsort($value);

            $templateTransfer->{$key} = $value;
        }
    }
}
