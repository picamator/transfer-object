<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Filesystem;

use Generator;
use Picamator\TransferObject\Config\Container\ConfigInterface;
use Picamator\TransferObject\Definition\Enum\DefinitionEnum;
use Picamator\TransferObject\Exception\DefinitionTransferException;
use Symfony\Component\Finder\Finder;
use Throwable;

readonly class DefinitionFilesystem implements DefinitionFilesystemInterface
{
    private const string FILE_NAME_PATTERN = DefinitionEnum::FILE_NAME_PATTERN->value;

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

    private function getDefinitionFinder(): Finder
    {
        try {
            return $this->finder->name(self::FILE_NAME_PATTERN)->in($this->config->getDefinitionPath())->files();
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
