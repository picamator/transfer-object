<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\File;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

interface ConfigFileValidatorInterface
{
    public function validate(string $filePath): ValidatorMessageTransfer;
}
