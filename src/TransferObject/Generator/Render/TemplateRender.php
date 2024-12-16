<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render;

use Picamator\TransferObject\Config\Container\ConfigInterface;
use Picamator\TransferObject\Exception\GeneratorTransferException;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\Generator\Enum\AttributeEnum;
use Picamator\TransferObject\Generator\Enum\AttributeTemplateEnum;
use Picamator\TransferObject\Generator\Enum\DefaultValueTemplateEnum;
use Picamator\TransferObject\Generator\Enum\DockBlockTemplateEnum;
use Picamator\TransferObject\Generator\Enum\TransferEnum;
use Picamator\TransferObject\Generator\Enum\TypeEnum;

readonly class TemplateRender implements TemplateRenderInterface
{
    use TemplateRenderTrait;

    private const string TEMPLATE_PATH = __DIR__ . DIRECTORY_SEPARATOR . 'Template.tpl.php';

    public function __construct(
        private ConfigInterface $config,
    ) {
    }

    public function renderTemplate(DefinitionContentTransfer $contentTransfer): string
    {
        $templateTransfer = $this->createTemplateTransfer($contentTransfer);

        ob_start();
        include self::TEMPLATE_PATH;
        $output = ob_get_clean();

        $lastError = error_get_last();
        if ($lastError === null && $output !== false) {
            return $output;
        }

        throw new GeneratorTransferException(
            sprintf(
                'Template render error "%s", line "%s".',
                $lastError['message'] ?? '',
                $lastError['line'] ?? '',
            ),
        );
    }

    private function createTemplateTransfer(DefinitionContentTransfer $contentTransfer): TemplateTransfer
    {
        $templateTransfer = new TemplateTransfer();
        $templateTransfer->classNamespace = $this->config->getTransferNamespace();
        $templateTransfer->className = $this->getTransferName($contentTransfer->className);
        $templateTransfer->imports[] = TransferEnum::ABSTRACT_CLASS_NAME->value;

        foreach ($contentTransfer->properties as $propertyTransfer) {
            $propertyName = $propertyTransfer->propertyName;
            $templateTransfer->metaConstants[$this->getMetaConstant($propertyName)] = $propertyTransfer->propertyName;

            match (true) {
                $this->isTransferCollectionType($propertyTransfer) => $this->expandTransferCollectionType($propertyTransfer, $templateTransfer),
                $this->isTransferType($propertyTransfer) => $this->expandTransferType($propertyTransfer, $templateTransfer),
                default => $this->expandDefaultType($propertyTransfer, $templateTransfer),
            };
        }

        $templateTransfer->propertiesCount = $templateTransfer->properties->count();

        $this->sortAndUnify($templateTransfer);

        return $templateTransfer;
    }

    private function expandDefaultType(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): void
    {
        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = $propertyTransfer->type;

        if ($this->isArrayObject($propertyTransfer)) {
            $templateTransfer->imports[] = TypeEnum::ARRAY_OBJECT->value;
            $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY_OBJECT_TEMPLATE->value;
            $templateTransfer->dockBlocks[$propertyName] = DockBlockTemplateEnum::ARRAY_OBJECT_TEMPLATE->value;

            return;
        }

        if ($this->isArray($propertyTransfer)) {
            $templateTransfer->defaultValues[$propertyName] = TypeEnum::ARRAY->value;
            $templateTransfer->dockBlocks[$propertyName] = DefaultValueTemplateEnum::ARRAY_TEMPLATE->value;
        }
    }

    private function expandTransferType(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): void
    {
        $templateTransfer->imports[] = AttributeEnum::TYPE_ATTRIBUTE->value;

        $transferName = $this->getTransferName($propertyTransfer->type);
        $propertyName = $propertyTransfer->propertyName;

        $templateTransfer->properties[$propertyName] = $transferName;
        $templateTransfer->attributes[$propertyName] = sprintf(AttributeTemplateEnum::TYPE_ATTRIBUTE->value, $transferName);
    }

    private function expandTransferCollectionType(DefinitionPropertyTransfer $propertyTransfer, TemplateTransfer $templateTransfer): void
    {
        $templateTransfer->imports[] = TypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->imports[] = AttributeEnum::COLLECTION_TYPE_ATTRIBUTE->value;

        $transferName = $this->getTransferName($propertyTransfer->collectionType);

        $propertyName = $propertyTransfer->propertyName;
        $templateTransfer->properties[$propertyName] = TypeEnum::ARRAY_OBJECT->value;
        $templateTransfer->attributes[$propertyName] = sprintf(AttributeTemplateEnum::COLLECTION_TYPE_ATTRIBUTE->value, $transferName);
        $templateTransfer->dockBlocks[$propertyName] = sprintf(DockBlockTemplateEnum::COLLECTION_TYPE_TEMPLATE->value, $transferName);
        $templateTransfer->defaultValues[$propertyName] = DefaultValueTemplateEnum::ARRAY_OBJECT_TEMPLATE->value;
    }
}
