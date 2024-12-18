<?php declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Config\Container;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Config\Container\ConfigContainer;
use Picamator\TransferObject\Exception\ConfigTransferException;
use Picamator\TransferObject\Transfer\Generated\ConfigTransfer;

class ConfigContainerTest extends TestCase
{
    private ConfigContainer $configContainer;

    protected function setUp(): void
    {
        $this->configContainer = new ConfigContainer();
    }

    public function testGetConfigWithoutLoadShouldThrowException(): void
    {
        $this->expectException(ConfigTransferException::class);

        $this->configContainer->getConfig();
    }

    public function testLoadConfigAndGetShouldReturnConfig(): void
    {
        $configTransfer = new ConfigTransfer()
            ->fromArray([
                ConfigTransfer::TRANSFER_NAMESPACE => 'Test\SomeNamespace',
                ConfigTransfer::TRANSFER_PATH => 'test\path\Generated',
                ConfigTransfer::DEFINITION_PATH => 'test\path\config\definitions',
            ]);

        $this->configContainer->loadConfig($configTransfer);

        $actual = $this->configContainer->getConfig();
        $this->assertSame($configTransfer->transferNamespace, $actual->getTransferNamespace());
        $this->assertSame($configTransfer->transferPath, $actual->getTransferPath());
        $this->assertSame($configTransfer->definitionPath, $actual->getDefinitionPath());
    }
}
