<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Config\Config;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigProxy;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException;

class ConfigProxyTest extends TestCase
{
    private ConfigInterface $proxy;

    protected function setUp(): void
    {
        $this->proxy = new ConfigProxy();
    }

    public function testGetTransferNamespaceWithoutLoadingConfigFirstShouldRiseException(): void
    {
        // Arrange
        ConfigProxy::resetConfig();

        // Expect
        $this->expectException(TransferGeneratorConfigNotFoundException::class);

        // Act
        $this->proxy->getTransferNamespace();
    }
}
