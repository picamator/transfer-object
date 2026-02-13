<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface;

readonly class TemplateBuilder implements TemplateBuilderInterface
{
    public function __construct(
        private ConfigInterface $config,
        private TemplateSorterInterface $templateSorter,
        private TemplateExpanderInterface $templateExpander,
    ) {
    }

    public function createTemplateTransfer(DefinitionTransfer $definitionTransfer): TemplateTransfer
    {
        $templateTransfer = new TemplateTransfer();
        $templateTransfer->definitionPath = $this->getDefinitionPath($definitionTransfer);
        $templateTransfer->classNamespace = $this->config->getTransferNamespace();
        $templateTransfer->className = $definitionTransfer->content->className;
        $templateTransfer->imports[TransferEnum::ABSTRACT_CLASS->value] = TransferEnum::ABSTRACT_CLASS->value;

        $this->expandProperties($definitionTransfer, $templateTransfer);

        $this->templateSorter->sortTemplateTransfer($templateTransfer);

        return $templateTransfer;
    }

    private function expandProperties(
        DefinitionTransfer $definitionTransfer,
        TemplateTransfer $templateTransfer,
    ): void {
        foreach ($definitionTransfer->content->properties as $propertyTransfer) {
            $this->templateExpander->expandTemplateTransfer($propertyTransfer, $templateTransfer);
        }
    }

    private function getDefinitionPath(DefinitionTransfer $definitionTransfer): string
    {
        return $this->config->getRelativeDefinitionPath() . DIRECTORY_SEPARATOR . $definitionTransfer->fileName;
    }
}
