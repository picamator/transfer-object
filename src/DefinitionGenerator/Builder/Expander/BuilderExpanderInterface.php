<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Expander;

use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;

interface BuilderExpanderInterface
{
    public function setNextExpander(BuilderExpanderInterface $expander): BuilderExpanderInterface;

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function expandBuilderTransfer(
        BuilderContentInterface $content,
        DefinitionBuilderTransfer $builderTransfer,
    ): void;
}
