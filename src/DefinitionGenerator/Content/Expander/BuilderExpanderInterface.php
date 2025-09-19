<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Expander;

use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;

interface BuilderExpanderInterface
{
    public function setNextExpander(BuilderExpanderInterface $expander): BuilderExpanderInterface;

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function expandBuilderTransfer(ContentInterface $content, DefinitionBuilderTransfer $builderTransfer): void;
}
