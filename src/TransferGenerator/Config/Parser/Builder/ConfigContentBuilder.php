<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Builder;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Shared\Environment\EnvironmentReaderInterface;

readonly class ConfigContentBuilder implements ConfigContentBuilderInterface
{
    protected const string PLACEHOLDER = '${PROJECT_ROOT}';

    protected const string HASH_FILE_NAME = 'transfer-object.list.csv';

    public function __construct(private EnvironmentReaderInterface $environmentReader)
    {
    }

    public function createContentTransfer(array $configData): ConfigContentTransfer
    {
        $configData[ConfigContentTransfer::UUID_PROP] = $this->getUuid();
        $configData[ConfigContentTransfer::HASH_FILE_NAME_PROP] = static::HASH_FILE_NAME;

        $contentTransfer = new ConfigContentTransfer($configData);

        $this->parseContentPath($contentTransfer);

        return $contentTransfer;
    }

    private function getUuid(): string
    {
        return uniqid('', true);
    }

    private function parseContentPath(ConfigContentTransfer $contentTransfer): void
    {
        $relativeDefinitionPath = $this->filterPath($contentTransfer->definitionPath);
        $contentTransfer->relativeDefinitionPath = $this->replacePlaceholder($relativeDefinitionPath, '');

        $projectRoot = $this->environmentReader->getProjectRoot();

        $definitionPath = $this->replacePlaceholder($contentTransfer->definitionPath, $projectRoot);
        $contentTransfer->definitionPath = $definitionPath;

        $transferPath = $this->replacePlaceholder($contentTransfer->transferPath, $projectRoot);
        $contentTransfer->transferPath = $transferPath;
    }

    private function filterPath(string $path): string
    {
        return rtrim($path, '\/');
    }

    private function replacePlaceholder(string $path, string $replace): string
    {
        return str_replace(static::PLACEHOLDER, $replace, $path);
    }
}
