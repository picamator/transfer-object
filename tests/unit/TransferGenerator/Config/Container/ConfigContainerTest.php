<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Config\Container;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigContainer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigException;

class ConfigContainerTest extends TestCase
{
    private ConfigContainer $configContainer;

    protected function setUp(): void
    {
        $this->configContainer = new ConfigContainer();
    }

    public function testGetConfigWithoutLoadShouldThrowException(): void
    {
        // Act
        $this->expectException(TransferGeneratorConfigException::class);

        // Assert
        $this->configContainer->getConfig();
    }

    public function testLoadConfigAndGetShouldReturnConfig(): void
    {
        // Arrange
        $contentTransfer = new ConfigContentTransfer()
            ->fromArray([
                ConfigContentTransfer::TRANSFER_NAMESPACE => 'Test\SomeNamespace',
                ConfigContentTransfer::TRANSFER_PATH => 'test\path\Generated',
                ConfigContentTransfer::DEFINITION_PATH => 'test\path\config\definitions',
            ]);

        $this->configContainer->loadConfig($contentTransfer);

        // Act
        $actual = $this->configContainer->getConfig();

        // Assert
        $this->assertSame($contentTransfer->transferNamespace, $actual->getTransferNamespace());
        $this->assertSame($contentTransfer->transferPath, $actual->getTransferPath());
        $this->assertSame($contentTransfer->definitionPath, $actual->getDefinitionPath());
    }
}
