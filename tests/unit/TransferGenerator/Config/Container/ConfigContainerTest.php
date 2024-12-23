<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Config\Container;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\ConfigTransfer;
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
        $configTransfer = new ConfigTransfer()
            ->fromArray([
                ConfigTransfer::TRANSFER_NAMESPACE => 'Test\SomeNamespace',
                ConfigTransfer::TRANSFER_PATH => 'test\path\Generated',
                ConfigTransfer::DEFINITION_PATH => 'test\path\config\definitions',
            ]);

        $this->configContainer->loadConfig($configTransfer);

        // Act
        $actual = $this->configContainer->getConfig();

        // Assert
        $this->assertSame($configTransfer->transferNamespace, $actual->getTransferNamespace());
        $this->assertSame($configTransfer->transferPath, $actual->getTransferPath());
        $this->assertSame($configTransfer->definitionPath, $actual->getDefinitionPath());
    }
}
