<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\Content;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\PathExistValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathLocalValidatorInterface;

readonly class DefinitionPathContentValidator implements ContentValidatorInterface
{
    public function __construct(
        private PathLocalValidatorInterface $pathLocalValidator,
        private PathExistValidatorInterface $pathValidator,
    ) {
    }

    public function validate(ConfigContentTransfer $configContentTransfer): ?ValidatorMessageTransfer
    {
        $path = $configContentTransfer->definitionPath;

        $validatorMessageTransfer = $this->pathLocalValidator->validate($path);
        if ($validatorMessageTransfer !== null) {
            return $validatorMessageTransfer;
        }

        return $this->pathValidator->validate($path);
    }
}
