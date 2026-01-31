<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper;

use Picamator\TransferObject\Generated\TemplateTransfer;

interface TemplateHelperInterface
{
    public function setTemplateTransfer(TemplateTransfer $templateTransfer): self;

    public function renderImports(): string;

    public function renderMetaData(): string;

    public function renderMetaInitiators(): string;

    public function renderMetaTransformers(): string;

    public function renderMetaAttributes(string $property): string;

    public function renderDocBlock(string $property): string;

    public function renderPropertyAttributes(string $property): string;

    public function renderPropertyDeclaration(string $property): string;

    public function renderRequired(string $property): string;
}
