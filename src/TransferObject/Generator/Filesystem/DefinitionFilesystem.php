<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Filesystem;

use Generator;
use Picamator\TransferObject\Exception\GeneratorTransferException;
use Picamator\TransferObject\Generator\Enum\DefinitionEnum;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Symfony\Component\Finder\Finder;
use Throwable;

class DefinitionFilesystem implements DefinitionFilesystemInterface
{
    private const string FILE_NAME_PATTERN = DefinitionEnum::FILE_NAME_PATTERN->value;

    private ?Finder $definitionFinder;

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

    public function countDefinitions(): int
    {
        return $this->getDefinitionFinder()->count();
    }

    private function getDefinitionFinder(): Finder
    {
        $pathTransfer = $this->configTransfer->definitionPath;

        try {
            return $this->definitionFinder ??= $this->finder->name(static::FILE_NAME_PATTERN)->in($pathTransfer->path)->files();
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
