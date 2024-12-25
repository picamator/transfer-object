<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader\Loader;

use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigContainer;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;

readonly class ConfigLoader implements ConfigLoaderInterface
{
    private const string CONFIG_SECTION_KEY = 'generator';

    public function __construct(
        private YmlParserInterface $parser,
        private ConfigValidatorInterface $validator,
    ) {
    }

    public function loadConfig(string $configPath): ValidatorMessageTransfer
    {
        $configContent = $this->parser->parseFile($configPath);
        $configTransfer = $this->createConfigTransfer($configContent);

        $messageTransfer = $this->validator->validate($configTransfer);
        if ($messageTransfer->isValid) {
            ConfigContainer::loadConfig($configTransfer);
        }

        return $messageTransfer;
    }

    /**
     * @param array<string,array<string,mixed>> $configContent
     */
    private function createConfigTransfer(array $configContent): ConfigTransfer
    {
        $configSection = $configContent[self::CONFIG_SECTION_KEY] ?? [];
        $configSection = array_filter($configSection, fn(mixed $configItem): bool => is_string($configItem));

        return new ConfigTransfer()->fromArray($configSection);
    }
}
