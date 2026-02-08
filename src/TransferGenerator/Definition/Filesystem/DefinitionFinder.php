<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Countable;
use Generator;
use IteratorAggregate;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException;

readonly class DefinitionFinder implements DefinitionFinderInterface
{
    private const string MAX_FILE_SIZE = '10M';

    private const string FILE_NAME_PATTERN = '*.transfer.yml';

    private const string DEFINITIONS_NOT_FOUND_ERROR_MESSAGE = 'Missing Transfer Object definitions.';

    public function __construct(
        private FinderInterface $finder,
        private ConfigInterface $config,
    ) {
    }

    public function getDefinitionFiles(): Generator
    {
        $definitionFinder = $this->findDefinitionFiles();
        foreach ($definitionFinder as $file) {
            yield $file->getFilename() => $file->getRealPath();
        }

        return $definitionFinder->count();
    }

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     *
     * @return Countable&IteratorAggregate<string,\Picamator\TransferObject\Dependency\Finder\SplFileInfoBridge>
     */
    private function findDefinitionFiles(): IteratorAggregate&Countable
    {
        $definitionFinder = $this->finder->findFilesInDirectory(
            filePattern: self::FILE_NAME_PATTERN,
            dirName: $this->config->getDefinitionPath(),
            maxFileSize: self::MAX_FILE_SIZE,
        );

        $fileCount = $definitionFinder->count();
        if ($fileCount === 0) {
            throw new TransferGeneratorDefinitionException(self::DEFINITIONS_NOT_FOUND_ERROR_MESSAGE);
        }

        return $definitionFinder;
    }
}
