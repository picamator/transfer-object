<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Generator;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\DefinitionTransferException;
use Symfony\Component\Finder\Finder;
use Throwable;

readonly class DefinitionFinder implements DefinitionFinderInterface
{
    private const string FILE_NAME_PATTERN = '*.transfer.yml';

    public function __construct(
        private Finder $finder,
        private ConfigInterface $config,
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

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\DefinitionTransferException
     */
    private function getDefinitionFinder(): Finder
    {
        try {
            return $this->finder
                ->files()
                ->name(self::FILE_NAME_PATTERN)
                ->in($this->config->getDefinitionPath());
        } catch (Throwable $e) {
            throw new DefinitionTransferException(
                sprintf(
                    'Failed find definition files "%s" in the "%s".',
                    $this->config->getDefinitionPath(),
                    self::FILE_NAME_PATTERN,
                ),
                previous: $e,
            );
        }
    }
}
