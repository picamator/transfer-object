<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\Content;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Validator\ValidatorMessageTrait;

readonly class RequiredConfigContentValidator implements ConfigContentValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Missing required configuration keys: "%s".';

    public function validate(ConfigContentTransfer $configContentTransfer): ValidatorMessageTransfer
    {
        $configContent = $configContentTransfer->toArray();
        $missedConfig = array_diff_key($configContent, array_filter($configContent));

        if (count($missedConfig) > 0) {
            $errorMessage = $this->getErrorMessage($missedConfig);

            return $this->createErrorMessageTransfer($errorMessage);
        }

        return $this->createSuccessMessageTransfer();
    }

    /**
     * @param array<string,string> $missedConfig
     */
    private function getErrorMessage(array $missedConfig): string
    {
        return sprintf(
            self::ERROR_MESSAGE_TEMPLATE,
            implode(', ', array_keys($missedConfig)),
        );
    }
}
