<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Validator;

use ArrayObject;
use Picamator\TransferObject\Transfer\Generated\ConfigTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class ConfigValidator implements ConfigValidatorInterface
{
    use ValidatorMessageTrait;

    /**
     * @param \ArrayObject<\Picamator\TransferObject\Config\Validator\ConfigValidatorInterface> $configValidators
     */
    public function __construct(
        private ArrayObject $configValidators,
    ) {
    }

    public function validate(ConfigTransfer $configTransfer): ValidatorMessageTransfer
    {
        foreach ($this->configValidators as $configValidator) {
            $messageTransfer = $configValidator->validate($configTransfer);
            if ($messageTransfer->isValid) {
                continue;
            }

            return $messageTransfer;
        }

        return $this->createSuccessMessageTransfer();
    }
}
