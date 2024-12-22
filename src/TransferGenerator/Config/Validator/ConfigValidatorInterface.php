<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface ConfigValidatorInterface
{
    public function validate(ConfigTransfer $configTransfer): ValidatorMessageTransfer;
}
