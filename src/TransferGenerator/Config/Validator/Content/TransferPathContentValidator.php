<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\Content;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\PathLocalValidatorInterface;

readonly class TransferPathContentValidator implements ContentValidatorInterface
{
    public function __construct(
        private PathLocalValidatorInterface $pathLocalValidator,
    ) {
    }

    public function validate(ConfigContentTransfer $configContentTransfer): ValidatorMessageTransfer
    {
        return $this->pathLocalValidator->validate($configContentTransfer->transferPath);
    }
}
