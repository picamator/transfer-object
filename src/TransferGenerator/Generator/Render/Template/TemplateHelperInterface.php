<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateHelperInterface
{
    public function setTemplateTransfer(TemplateTransfer $templateTransfer): self;

    public function renderImports(): string;

    public function renderMetaData(): string;

    public function renderMetaAttributes(string $property): string;

    public function renderDockBlock(string $property): string;

    public function renderPropertyDeclaration(string $property): string;

    public function renderNullable(string $property): string;
}
