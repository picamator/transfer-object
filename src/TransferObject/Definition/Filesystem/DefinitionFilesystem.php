<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Filesystem;

use Generator;
use Picamator\TransferObject\Definition\Enum\DefinitionEnum;
use Picamator\TransferObject\Exception\GeneratorTransferException;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Symfony\Component\Finder\Finder;
use Throwable;

class DefinitionFilesystem implements DefinitionFilesystemInterface
{
    private const string FILE_NAME_PATTERN = DefinitionEnum::FILE_NAME_PATTERN->value;

    public function __construct(
        private readonly Finder $finder,
        private readonly ConfigTransfer $configTransfer,
    ) {
    }

    public function getDefinitionContent(): Generator
    {
        $definitionFinder = $this->getDefinitionFinder();
        foreach ($definitionFinder as $file) {
            yield $file->getFilename() => $file->getContents();
        }
    }

    private function getDefinitionFinder(): Finder
    {
        $pathTransfer = $this->configTransfer->definitionPath;

        try {
            return $this->finder->name(static::FILE_NAME_PATTERN)->in($pathTransfer->path)->files();
        } catch (Throwable $e) {
            throw new GeneratorTransferException(
                sprintf(
                    'Failed find definition files "%s" in the "%s".',
                    $pathTransfer->path,
                    static::FILE_NAME_PATTERN,
                ),
                previous: $e,
            );
        }
    }
}
