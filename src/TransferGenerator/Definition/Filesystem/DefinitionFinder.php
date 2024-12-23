<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Generator;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigInterface;

readonly class DefinitionFinder implements DefinitionFinderInterface
{
    private const string FILE_NAME_PATTERN = '*.transfer.yml';

    public function __construct(
        private FinderInterface $finder,
        private ConfigInterface $config,
    ) {
    }

    public function getDefinitionContent(): Generator
    {
        $definitionFinder = $this->finder->findFilesInDirectory(
            filePattern: self::FILE_NAME_PATTERN,
            dirName: $this->config->getDefinitionPath(),
        );

        foreach ($definitionFinder as $file) {
            yield $file->getFilename() => $file->getContents();
        }

        return $definitionFinder->count();
    }
}
