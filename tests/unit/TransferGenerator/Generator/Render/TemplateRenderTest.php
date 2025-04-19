<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Render;

use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\TransferEnum;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateHelper;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRender;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

class TemplateRenderTest extends TestCase
{
    private TemplateRenderInterface $render;

    private TemplateBuilderInterface&MockObject $builderMock;

    protected function setUp(): void
    {
        $this->builderMock = $this->createMock(TemplateBuilderInterface::class);
        $templateHelper = new TemplateHelper();

        $this->render = new TemplateRender($this->builderMock, $templateHelper);
    }

    #[WithoutErrorHandler]
    public function testTemplateTransferKeyMismatchShouldThrowException(): void
    {
        // Arrange
        $contentTransfer = new DefinitionContentTransfer();

        $templateTransfer = $this->createTemplateTransfer();
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

        return new TemplateTransfer()->fromArray([
            TemplateTransfer::CLASS_NAMESPACE => '\Default',
            TemplateTransfer::CLASS_NAME => 'DefaultTransfer',
            TemplateTransfer::IMPORTS => [
                TransferEnum::ABSTRACT_CLASS->value,
            ],
        ]);
    }
}
