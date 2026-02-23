<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Countable;
use Generator;
use IteratorAggregate;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Shared\Environment\EnvironmentReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException;

readonly class DefinitionFinder implements DefinitionFinderInterface
{
    private const string FILE_NAME_PATTERN = '*.transfer.yml';

    private const string DEFINITIONS_NOT_FOUND_ERROR_MESSAGE = 'Missing Transfer Object definitions.';

    public function __construct(
        private FinderInterface $finder,
        private EnvironmentReaderInterface $environmentReader,
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
        $maxFileSize = $this->environmentReader->getMaxFileSizeMegabytes() . 'M';

        $definitionFinder = $this->finder->findFilesInDirectory(
            filePattern: self::FILE_NAME_PATTERN,
            dirName: $this->config->getDefinitionPath(),
            maxFileSize: $maxFileSize,
        );

        $fileCount = $definitionFinder->count();
        if ($fileCount === 0) {
            throw new TransferGeneratorDefinitionException(self::DEFINITIONS_NOT_FOUND_ERROR_MESSAGE);
        }

        return $definitionFinder;
    }
}
