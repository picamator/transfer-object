<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader\Reader;

use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\ConfigTransfer;

readonly class ConfigReader implements ConfigReaderInterface
{
    private const string CONFIG_SECTION_KEY = 'generator';

    private const string PROJECT_ROOT_PLACEHOLDER = '${PROJECT_ROOT}';
    private const string PROJECT_ROOT_ENV = 'PROJECT_ROOT';

    public function __construct(
        private YmlParserInterface $parser,
    ) {
    }

    public function getConfig(string $configPath): ConfigTransfer
    {
        $configContent = $this->parser->parseFile($configPath);
        $renderedConfig = $this->renderConfigContent($configContent);

        return new ConfigTransfer()->fromArray($renderedConfig);
    }

    /**
     * @param array<string,array<string,mixed>> $configContent
     *
     * @return array<string,string>
     */
    private function renderConfigContent(array $configContent): array
    {
        $configSection = $configContent[self::CONFIG_SECTION_KEY] ?? [];
        $projectRoot = getenv(self::PROJECT_ROOT_ENV) ?: '';

        $renderedConfig = [];
        foreach ($configSection as $key => $value) {
            if (!is_string($value)) {
                continue;
            }

            $renderedConfig[$key] = str_replace(self::PROJECT_ROOT_PLACEHOLDER, $projectRoot, $value);
        }

        return $renderedConfig;
    }
}
