<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use ArrayObject;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class ConfigValidator implements ConfigValidatorInterface
{
    use ValidatorMessageTrait;

    /**
     * @param \ArrayObject<int,\Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface> $configValidators
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
