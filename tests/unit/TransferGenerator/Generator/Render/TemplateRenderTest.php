<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Render;

use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
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

        $templateTransfer = new TemplateTransfer();
        $templateTransfer->classNamespace = '';
        $templateTransfer->className = '';
        $templateTransfer->propertiesCount = 1;
        $templateTransfer->metaConstants['TEST_PROPERTY'] = 'testProperty';

        $this->builderMock->expects($this->once())
            ->method('createTemplateTransfer')
            ->willReturn($templateTransfer);

        $this->expectException(TransferGeneratorException::class);

        // Act
        $this->render->renderTemplate($contentTransfer);
    }
}
