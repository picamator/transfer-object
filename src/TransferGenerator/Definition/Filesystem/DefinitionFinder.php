<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Generator;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException;

readonly class DefinitionFinder implements DefinitionFinderInterface
{
    private const string FILE_NAME_PATTERN = '*.transfer.yml';

    private const string DEFINITIONS_NOT_FOUND_ERROR_MESSAGE = 'Missed Transfer Object definitions.';

    public function __construct(
        private FinderInterface $finder,
        private ConfigInterface $config,
    ) {
    }

    public function getDefinitionFiles(): Generator
    {
        $definitionFinder =  $this->finder->findFilesInDirectory(
            filePattern: self::FILE_NAME_PATTERN,
            dirName: $this->config->getDefinitionPath(),
        );

        foreach ($definitionFinder as $file) {
            yield $file->getFilename() => $file->getRealPath();
        }

        if ($definitionFinder->count() === 0) {
            throw new TransferGeneratorDefinitionException(self::DEFINITIONS_NOT_FOUND_ERROR_MESSAGE);
        }

        return $definitionFinder->count();
    }
}
