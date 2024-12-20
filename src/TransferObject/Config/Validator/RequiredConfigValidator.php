<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Validator;

use Picamator\TransferObject\Transfer\Generated\ConfigTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class RequiredConfigValidator implements ConfigValidatorInterface
{
    use ValidatorMessageTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Missed required configuration keys "%s".';

    public function validate(ConfigTransfer $configTransfer): ValidatorMessageTransfer
    {
        $configContent = $configTransfer->toArray();
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
            implode(',', array_keys($missedConfig)),
        );
    }
}
