<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemBridge;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\Finder\FinderBridge;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserBridge;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Shared\CachedFactoryTrait;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Parser;

trait DependencyFactoryTrait
{
    use CachedFactoryTrait;

    final protected function createFilesystem(): FilesystemInterface
    {
        return $this->getCached(
            key: 'dependency:Filesystem',
            factory: fn(): FilesystemInterface => new FilesystemBridge(new Filesystem()),
        );
    }

    final protected function createFinder(): FinderInterface
    {
        return $this->getCached(
            key: 'dependency:Finder',
            factory: fn(): FinderInterface => new FinderBridge(),
        );
    }

    final protected function createYmlParser(): YmlParserInterface
    {
        return $this->getCached(
            key: 'dependency:YmlParser',
            factory: fn(): YmlParserInterface => new YmlParserBridge(new Parser()),
        );
    }
}
