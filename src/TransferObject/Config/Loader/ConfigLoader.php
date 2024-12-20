<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Loader;

use Picamator\TransferObject\Config\Container\ConfigContainer;
use Picamator\TransferObject\Config\Parser\FileParserInterface;
use Picamator\TransferObject\Config\Validator\ConfigValidatorInterface;
use Picamator\TransferObject\Transfer\Generated\ConfigTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class ConfigLoader implements ConfigLoaderInterface
{
    private const string CONFIG_SECTION_KEY = 'generator';

    public function __construct(
        private FileParserInterface $parser,
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
     * @param array<string,array<string,string>> $configContent
     */
    private function createConfigTransfer(array $configContent): ConfigTransfer
    {
        $configSection = $configContent[self::CONFIG_SECTION_KEY] ?? [];

        return new ConfigTransfer()->fromArray($configSection);
    }
}
