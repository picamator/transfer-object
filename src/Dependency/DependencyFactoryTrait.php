<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;

trait DependencyFactoryTrait
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\ServiceNotFoundException
     */
    final protected function getDependency(string $id): mixed
    {
        return new DependencyContainer()->get($id);
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\ServiceNotFoundException
     */
    final protected function getFilesystem(): FilesystemInterface
    {
        /** @var \Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface $fileSystem */
        $fileSystem = $this->getDependency(DependencyContainer::FILESYSTEM);

        return $fileSystem;
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\ServiceNotFoundException
     */
    final protected function getFinder(): FinderInterface
    {
        /** @var \Picamator\TransferObject\Dependency\Finder\FinderInterface $finder */
        $finder = $this->getDependency(DependencyContainer::FINDER);

        return $finder;
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\ServiceNotFoundException
     */
    final protected function getYmlParser(): YmlParserInterface
    {
        /** @var \Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface $ymlParser */
        $ymlParser = $this->getDependency(DependencyContainer::YML_PARSER);

        return $ymlParser;
    }
}
