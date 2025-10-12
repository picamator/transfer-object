<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Expander;

use Picamator\TransferObject\DefinitionGenerator\Content\Builder\Content;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;

abstract class AbstractBuilderExpander implements BuilderExpanderInterface
{
    private ?BuilderExpanderInterface $nextExpander = null;

    public function setNextExpander(BuilderExpanderInterface $expander): BuilderExpanderInterface
    {
        $this->nextExpander = $expander;

        return $expander;
    }

    public function expandBuilderTransfer(Content $content, DefinitionBuilderTransfer $builderTransfer): void
    {
        if ($this->isApplicable($content)) {
            $this->handleExpander($content, $builderTransfer);

            return;
        }

        $this->nextExpander?->expandBuilderTransfer($content, $builderTransfer);
    }

    abstract protected function isApplicable(Content $content): bool;

    abstract protected function handleExpander(
        Content $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void;
}
