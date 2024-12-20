<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Validator;

use Picamator\TransferObject\Transfer\Generated\ConfigTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

interface ConfigValidatorInterface
{
    public function validate(ConfigTransfer $configTransfer): ValidatorMessageTransfer;
}
