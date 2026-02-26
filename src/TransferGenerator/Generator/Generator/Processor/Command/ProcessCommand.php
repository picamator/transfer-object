<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Writer\TransferWriterInterface;

readonly class ProcessCommand implements ProcessCommandInterface
{
    public function __construct(
        private TransferGeneratorBuilderInterface $builder,
        private TemplateRenderInterface $render,
        private TransferWriterInterface $transferWriter,
    ) {
    }

    public function process(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer
    {
        if (!$definitionTransfer->validator->isValid) {
            return $this->builder->createGeneratorTransferByDefinition($definitionTransfer);
        }

        return $this->generateTransfer($definitionTransfer);
    }

    private function generateTransfer(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer
    {
        try {
            $contentTransfer = $this->renderContent($definitionTransfer);
            $this->saveContent($contentTransfer);

            return $this->builder->createGeneratorTransferByDefinition($definitionTransfer);
        } catch (FilesystemException | TransferGeneratorException $e) {
            return $this->builder->createErrorWithDefinitionGeneratorTransfer($e->getMessage(), $definitionTransfer);
        }
    }

    private function saveContent(TransferGeneratorContentTransfer $contentTransfer): void
    {
        $this->transferWriter->writeFile($contentTransfer);
    }

    private function renderContent(DefinitionTransfer $definitionTransfer): TransferGeneratorContentTransfer
    {
        return $this->render->renderTemplate($definitionTransfer);
    }
}
