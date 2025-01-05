<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Render;

use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\TemplateHelper;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRender;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

class TemplateRenderTest extends TestCase
{
    private TemplateRenderInterface $render;

    private TemplateBuilderInterface&MockObject $builderMock;

    protected function setUp(): void
    {
        $this->builderMock = $this->createMock(TemplateBuilderInterface::class);

        $this->render = new TemplateRender($this->builderMock);
    }

    #[WithoutErrorHandler]
    public function testTemplateTransferKeyMismatchShouldThrowException(): void
    {
        // Arrange
        $contentTransfer = new DefinitionContentTransfer();

        $templateTransfer = $this->createTemplateTransfer();
        $templateTransfer->propertiesCount = 1;
        $templateTransfer->metaConstants['TEST_PROPERTY'] = 'testProperty';

        // Expect
        $this->builderMock->expects($this->once())
            ->method('createTemplateTransfer')
            ->willReturn($templateTransfer);

        $this->expectException(TransferGeneratorException::class);

        // Act
        $this->render->renderTemplate($contentTransfer);
    }

    public function testEmptyTemplateRenderingShouldSucceed(): void
    {
        // Arrange
        $contentTransfer = new DefinitionContentTransfer();
        $templateTransfer = $this->createTemplateTransfer();

        // Expect
        $this->builderMock->expects($this->once())
            ->method('createTemplateTransfer')
            ->willReturn($templateTransfer);

        // Act
        $actual = $this->render->renderTemplate($contentTransfer);

        // Assert
        $this->assertStringContainsString('extends AbstractTransfer', $actual);
    }

    private function createTemplateTransfer(): TemplateTransfer
    {
        return TemplateHelper::getDefaultTemplateTransfer();
    }
}
