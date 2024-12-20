<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Validator;

use Picamator\TransferObject\Config\Filesystem\ConfigFilesystemInterface;
use Picamator\TransferObject\Transfer\Generated\ConfigTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class DefinitionPathConfigValidator implements ConfigValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Definition path "%s" is not exists.';

    public function __construct(
        private ConfigFilesystemInterface $filesystem
    ) {
    }

    public function validate(ConfigTransfer $configTransfer): ValidatorMessageTransfer
    {
        $definitionPath = $configTransfer->definitionPath ?? '';
        $isExists = $this->filesystem->exists($definitionPath);

        if (!$isExists) {
            $errorMessage = $this->getErrorMessage($definitionPath);

            return $this->createErrorMessageTransfer($errorMessage);
        }

        return $this->createSuccessMessageTransfer();
    }

    private function getErrorMessage(string $definitionPath): string
    {
        return sprintf(self::ERROR_MESSAGE_TEMPLATE, $definitionPath);
    }
}
