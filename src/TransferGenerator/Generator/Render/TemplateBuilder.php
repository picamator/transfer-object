<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface;

readonly class TemplateBuilder implements TemplateBuilderInterface
{
    public function __construct(
        private ConfigInterface $config,
        private TemplateExpanderInterface $templateExpander,
    ) {
    }

    public function createTemplateTransfer(DefinitionContentTransfer $contentTransfer): TemplateTransfer
    {
        $templateTransfer = new TemplateTransfer();
        $templateTransfer->classNamespace = $this->config->getTransferNamespace();
        $templateTransfer->className = $contentTransfer->className;
        $templateTransfer->imports[TransferEnum::ABSTRACT_CLASS->value] = TransferEnum::ABSTRACT_CLASS->value;
        $templateTransfer->imports[TransferEnum::TRAIT->value] = TransferEnum::TRAIT->value;

        foreach ($contentTransfer->properties as $propertyTransfer) {
            $this->templateExpander->expandTemplateTransfer($propertyTransfer, $templateTransfer);
        }

        $this->sortTemplate($templateTransfer);

        return $templateTransfer;
    }

    private function sortTemplate(TemplateTransfer $templateTransfer): void
    {
        $templateTransfer->imports->natsort();
        $templateTransfer->metaConstants->natsort();
    }
}
