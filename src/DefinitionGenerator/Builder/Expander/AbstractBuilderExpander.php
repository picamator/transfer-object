<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Picamator\TransferObject\DefinitionGenerator\Builder\ContentInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;

abstract class AbstractBuilderExpander implements BuilderExpanderInterface
{
    private ?BuilderExpanderInterface $nextExpander = null;

    public function setNextExpander(BuilderExpanderInterface $expander): BuilderExpanderInterface
    {
        $this->nextExpander = $expander;

        return $expander;
    }

    public function expandBuilderTransfer(ContentInterface $content, DefinitionBuilderTransfer $builderTransfer): void
    {
        if ($this->isApplicable($content)) {
            $this->handleExpander($content, $builderTransfer);

            return;
        }

        $this->nextExpander?->expandBuilderTransfer($content, $builderTransfer);
    }

    abstract protected function isApplicable(ContentInterface $content): bool;

    abstract protected function handleExpander(
        ContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void;
}
