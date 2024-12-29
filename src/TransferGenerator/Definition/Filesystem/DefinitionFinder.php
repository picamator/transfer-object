<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Countable;
use Generator;
use IteratorAggregate;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Dependency\Finder\SplFileInfoBridge;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigInterface;

class DefinitionFinder implements DefinitionFinderInterface
{
    private const string FILE_NAME_PATTERN = '*.transfer.yml';

    /**
     * @var Countable&IteratorAggregate<string,SplFileInfoBridge>
     */
    private Countable&IteratorAggregate $definitionFinder;

    public function __construct(
        private readonly FinderInterface $finder,
        private readonly ConfigInterface $config,
    ) {
    }

    public function getDefinitionContent(): Generator
    {
        $definitionFinder = $this->getDefinitionFinder();
        foreach ($definitionFinder as $file) {
            yield $file->getFilename() => $file->getContents();
        }

        return $definitionFinder->count();
    }

    public function getDefinitionCount(): int
    {
        return $this->getDefinitionFinder()->count();
    }

    /**
     * @return Countable&IteratorAggregate<string,SplFileInfoBridge>
     */
    private function getDefinitionFinder(): Countable&IteratorAggregate
    {
        $this->definitionFinder ??=  $this->finder->findFilesInDirectory(
            filePattern: self::FILE_NAME_PATTERN,
            dirName: $this->config->getDefinitionPath(),
        );

        return $this->definitionFinder;
    }
}
