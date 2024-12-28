<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Enum\ConfigKeyEnum;

readonly class ConfigParser implements ConfigParserInterface
{
    private const string CONFIG_SECTION_KEY = 'generator';

    private const string PROJECT_ROOT_PLACEHOLDER = '${PROJECT_ROOT}';
    private const string PROJECT_ROOT_ENV = 'PROJECT_ROOT';

    public function __construct(
        private YmlParserInterface $parser,
    ) {
    }

    public function parseConfig(string $configPath): ConfigContentTransfer
    {
        $parsedConfig = $this->parseFile($configPath);
        $contentTransfer = new ConfigContentTransfer()->fromArray($parsedConfig);

        return $this->renderProjectRoot($contentTransfer);
    }

    private function renderProjectRoot(ConfigContentTransfer $contentTransfer): ConfigContentTransfer
    {
        $projectRoot = $this->getProjectRoot();

        foreach (ConfigKeyEnum::getPathKeys() as $key) {
            $contentTransfer->{$key->value} = str_replace(
                search: self::PROJECT_ROOT_PLACEHOLDER,
                replace: $projectRoot,
                subject: $contentTransfer->{$key->value} ?? '',
            );
        }

        return $contentTransfer;
    }

    private function getProjectRoot(): string
    {
        return getenv(self::PROJECT_ROOT_ENV) ?: '';
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     *
     * @return array<string,string>
     */
    private function parseFile(string $configPath): array
    {
        $configContent = $this->parser->parseFile($configPath);
        $configSection = $configContent[self::CONFIG_SECTION_KEY] ?? [];

        return array_filter($configSection, fn(mixed $configItem): bool => is_string($configItem));
    }
}
