<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

interface TemplateHelperInterface
{
    /**
     * @param iterable<string,string> $data
     */
    public function renderKeyValue(iterable $data, string $template): string;

    public function getAttribute(string $property): string;

    public function getDockBlock(string $property): string;

    public function getNullable(string $property): string;

    public function getDefault(string $property): string;
}
