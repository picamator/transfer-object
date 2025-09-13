<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Render;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Template;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\TemplateHelper;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRender;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

#[Group('transfer-generator')]
class TemplateRenderTest extends TestCase
{
    private TemplateRenderInterface $render;

    private TemplateBuilderInterface&Stub $builderStub;

    protected function setUp(): void
    {
        $this->builderStub = $this->createStub(TemplateBuilderInterface::class);

        $templateHelper = new TemplateHelper();

        $template = new Template($templateHelper);

        $this->render = new TemplateRender($this->builderStub, $template);
    }

    public function testEmptyTemplateRenderingShouldSucceed(): void
    {
        // Arrange
        $definitionTransfer = new DefinitionTransfer();
        $definitionTransfer->fileName = 'definition.yml';
        $definitionTransfer->content = new DefinitionContentTransfer([
            DefinitionContentTransfer::CLASS_NAME => 'CustomerTransfer',
        ]);

        $templateTransfer = $this->createTemplateTransfer();

        $this->builderStub
            ->method('createTemplateTransfer')
            ->willReturn($templateTransfer);

        // Act
        $actual = $this->render->renderTemplate($definitionTransfer);

        // Assert
        $this->assertStringContainsString('extends AbstractTransfer', $actual->content);
    }

    private function createTemplateTransfer(): TemplateTransfer
    {
        return new TemplateTransfer([
            TemplateTransfer::DEFINITION_PATH => '\some\path\definition.yml',
            TemplateTransfer::CLASS_NAMESPACE => '\Default',
            TemplateTransfer::CLASS_NAME => 'DefaultTransfer',
            TemplateTransfer::IMPORTS => [
                TransferEnum::ABSTRACT_CLASS->value,
            ],
        ]);
    }
}
