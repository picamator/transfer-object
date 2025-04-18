<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateHelperInterface
{
    public function setTemplateTransfer(TemplateTransfer $templateTransfer): self;

    /**
     * @param iterable<string|int,string> $data
     */
    public function renderKeyValue(iterable $data, string $template): string;

    public function getAttribute(string $property): string;

    public function getDockBlock(string $property): string;

    public function getNullable(string $property): string;

    public function isRequired(string $property): string;
}
