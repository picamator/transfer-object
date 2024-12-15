<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\DefinitionGenerator;

interface DefinitionGeneratorInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function generateDefinitions(): bool;
}
