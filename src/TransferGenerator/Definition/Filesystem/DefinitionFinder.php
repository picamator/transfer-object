<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Countable;
use Generator;
use IteratorAggregate;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Dependency\Finder\SplFileInfoBridge;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException;

class DefinitionFinder implements DefinitionFinderInterface
{
    private const string FILE_NAME_PATTERN = '*.transfer.yml';

    private const string DEFINITIONS_NOT_FOUND_ERROR_MESSAGE = 'Missed Transfer Object definitions.';

    /**
     * @var Countable&IteratorAggregate<string,SplFileInfoBridge>
     */
    private Countable&IteratorAggregate $definitionFinder;

    public function __construct(
        private readonly FinderInterface $finder,
        private readonly ConfigInterface $config,
    ) {
    }

    public function getDefinitionFiles(): Generator
    {
        $definitionFinder = $this->getDefinitionFinder();
        foreach ($definitionFinder as $file) {
            yield $file->getFilename() => $file->getRealPath();
        }

        if ($definitionFinder->count() === 0) {
            throw new TransferGeneratorDefinitionException(self::DEFINITIONS_NOT_FOUND_ERROR_MESSAGE);
        }

        return $definitionFinder->count();
    }

    public function getDefinitionFileCount(): int
    {
        return $this->getDefinitionFinder()->count();
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     *
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
