<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\Content;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

readonly class RequiredContentValidator implements ContentValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Missing required configuration keys: "%s".';

    public function validate(ConfigContentTransfer $configContentTransfer): ?ValidatorMessageTransfer
    {
        $missedKeys = $this->getMissedKeys($configContentTransfer);
        if (count($missedKeys) === 0) {
            return null;
        }

        $errorMessage = $this->getErrorMessage($missedKeys);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    /**
     * @return array<int,string>
     */
    private function getMissedKeys(ConfigContentTransfer $configContentTransfer): array
    {
        $missedKeys = [];
        foreach ($configContentTransfer as $configKey => $configValue) {
            if ($configValue !== null && $configValue !== '') {
                continue;
            }

            $missedKeys[] = $configKey;
        }

        return $missedKeys;
    }

    /**
     * @param array<int,string> $missedKeys
     */
    private function getErrorMessage(array $missedKeys): string
    {
        return sprintf(
            self::ERROR_MESSAGE_TEMPLATE,
            implode(', ', $missedKeys),
        );
    }
}
