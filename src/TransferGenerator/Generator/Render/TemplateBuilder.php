<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use ArrayObject;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;

readonly class TemplateBuilder implements TemplateBuilderInterface
{
    use TemplateRenderTrait;

    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface> $templateExpanders
     */
    public function __construct(
        private ConfigInterface $config,
        private ArrayObject $templateExpanders,
    ) {
    }

    public function buildTemplateTransfer(DefinitionContentTransfer $contentTransfer): TemplateTransfer
    {
        $templateTransfer = new TemplateTransfer();
        $templateTransfer->classNamespace = $this->config->getTransferNamespace();
        $templateTransfer->className = $this->getTransferName($contentTransfer->className);
        $templateTransfer->imports[TransferEnum::ABSTRACT_CLASS->value] = TransferEnum::ABSTRACT_CLASS->value;

        foreach ($contentTransfer->properties as $propertyTransfer) {
            $propertyName = $propertyTransfer->propertyName;
            $templateTransfer->metaConstants[$this->getMetaConstant($propertyName)] = $propertyTransfer->propertyName;

            $this->handleTemplateExpanders($propertyTransfer, $templateTransfer);
        }

        $templateTransfer->propertiesCount = $templateTransfer->properties->count();
        $this->sortTemplate($templateTransfer);

        return $templateTransfer;
    }

    private function handleTemplateExpanders(
        DefinitionPropertyTransfer $propertyTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        foreach ($this->templateExpanders as $expander) {
            if (!$expander->isApplicable($propertyTransfer)) {
                continue;
            }

            $expander->expandTemplateTransfer($propertyTransfer, $templateTransfer);
        }
    }
}