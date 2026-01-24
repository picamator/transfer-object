<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Shared\CachedFactoryTrait;
use Picamator\TransferObject\Shared\Initializer\LazyGhostInitializerTrait;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\AttributesTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\BuildInTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\CollectionTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\DateTimeTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\EnumTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\MetaConstantsTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\NamespaceTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\NumberTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\ProtectedTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TemplateExpanderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Expander\TransferTypeTemplateExpander;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper\TemplateHelper;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper\TemplateHelperInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Template;

class RenderFactory
{
    use ConfigFactoryTrait;
    use CachedFactoryTrait;
    use LazyGhostInitializerTrait;

    public function createTemplateRender(): TemplateRenderInterface
    {
        /** @var TemplateRenderInterface $templateRender */
        $templateRender = $this->getLazyGhost(
            className: TemplateRender::class,
            initializer: function (TemplateRender $ghost): void {
                $ghost->__construct(
                    $this->createTemplateBuilder(),
                    $this->createTemplate(),
                );
            }
        );

        return $templateRender;
    }

    protected function createTemplate(): Template
    {
        return new Template($this->createTemplateHelper());
    }

    protected function createTemplateHelper(): TemplateHelperInterface
    {
        return new TemplateHelper();
    }

    protected function createTemplateBuilder(): TemplateBuilderInterface
    {
        return new TemplateBuilder(
            $this->getConfig(),
            $this->createTemplateExpander(),
        );
    }

    protected function createTemplateExpander(): TemplateExpanderInterface
    {
        $templateExpander = $this->createCollectionTypeTemplateExpander();

        $templateExpander
            ->setNextExpander($this->createTransferTypeTemplateExpander())
            ->setNextExpander($this->createBuildInTypeTemplateExpander())
            ->setNextExpander($this->createEnumTypeTemplateExpander())
            ->setNextExpander($this->createNamespaceTemplateExpander())
            ->setNextExpander($this->createMetaConstantsTemplateExpander())
            ->setNextExpander($this->createProtectedTemplateExpander())
            ->setNextExpander($this->createDateTimeTypeTemplateExpander())
            ->setNextExpander($this->createNumberTypeTemplateExpander())
            ->setNextExpander($this->createAttributesTemplateExpander());

        return $templateExpander;
    }

    protected function createAttributesTemplateExpander(): TemplateExpanderInterface
    {
        return new AttributesTemplateExpander();
    }

    protected function createNumberTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new NumberTypeTemplateExpander();
    }

    protected function createDateTimeTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new DateTimeTypeTemplateExpander();
    }

    protected function createProtectedTemplateExpander(): TemplateExpanderInterface
    {
        return new ProtectedTemplateExpander();
    }

    protected function createMetaConstantsTemplateExpander(): TemplateExpanderInterface
    {
        return new MetaConstantsTemplateExpander();
    }

    protected function createNamespaceTemplateExpander(): TemplateExpanderInterface
    {
        return new NamespaceTemplateExpander();
    }

    protected function createEnumTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new EnumTypeTemplateExpander();
    }

    protected function createBuildInTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new BuildInTypeTemplateExpander();
    }

    protected function createTransferTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new TransferTypeTemplateExpander();
    }

    protected function createCollectionTypeTemplateExpander(): TemplateExpanderInterface
    {
        return new CollectionTypeTemplateExpander();
    }
}
