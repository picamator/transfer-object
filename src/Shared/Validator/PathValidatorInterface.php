<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface PathValidatorInterface
{
    public function validate(string $path): ValidatorMessageTransfer;
}
