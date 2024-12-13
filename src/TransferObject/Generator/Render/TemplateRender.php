<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Render;

use ArrayObject;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\Generator\Enum\TransferEnum;
use Picamator\TransferObject\Generator\Expander\TemplateExpanderInterface;

readonly class TemplateRender implements TemplateRenderInterface
{
    private const string TEMPLATE_PATH = __DIR__ . DIRECTORY_SEPARATOR . '../Template/Transfer.tpl.php';

    public function __construct(
        private ConfigTransfer $configTransfer,
        private TemplateExpanderInterface $expander,
    ) {
    }

    public function renderTemplate(DefinitionContentTransfer $contentTransfer): string
    {
        $templateTransfer = $this->createTemplateTransfer($contentTransfer);

        ob_start();

        include static::TEMPLATE_PATH;

        return ob_get_clean();
    }

    private function createTemplateTransfer(DefinitionContentTransfer $contentTransfer): TemplateTransfer
    {
        $templateTransfer = new TemplateTransfer();
        $templateTransfer->classNamespace = $this->configTransfer->classNamespace;
        $templateTransfer->className = $this->getTransferName($contentTransfer->className);

        $templateTransfer->imports = new ArrayObject([TransferEnum::ABSTRACT_CLASS_NAME->value]);
        $templateTransfer->propertiesCount = 0;
        $templateTransfer->properties = new ArrayObject();
        $templateTransfer->metaConstants = new ArrayObject();
        $templateTransfer->attributes = new ArrayObject();
        $templateTransfer->dockBlocks = new ArrayObject();

        foreach ($contentTransfer->properties as $propertyTransfer) {
            $propertyName = $propertyTransfer->propertyName;
            $templateTransfer->metaConstants[$this->getMetaConstant($propertyName)] = $propertyTransfer->propertyName;;
            $this->expander->expandTemplate($propertyTransfer, $templateTransfer);
        }

        $templateTransfer->imports = new ArrayObject(array_unique($templateTransfer->imports->getArrayCopy()));
        $templateTransfer->propertiesCount = $templateTransfer->properties->count();

        $this->sortTemplateTransfer($templateTransfer);

        return $templateTransfer;
    }

    private function sortTemplateTransfer(TemplateTransfer $templateTransfer): void
    {
        foreach ($templateTransfer as $key => $value) {
            if (!$value instanceof ArrayObject) {
                continue;
            }

            $value = $value->getArrayCopy();
            natsort($value);

            $templateTransfer->{$key} = new ArrayObject($value);
        }
    }

    private function getMetaConstant(string $propertyName): string
    {
        return strtoupper(preg_replace('/([A-Z])/', '_$0', $propertyName));
    }

    private function getTransferName(string $propertyType): string
    {
        return $propertyType . TransferEnum::FILE_NAME_SUFFIX->value;
    }
}
