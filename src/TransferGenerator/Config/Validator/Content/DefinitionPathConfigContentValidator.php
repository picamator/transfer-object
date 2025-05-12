<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\Content;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\PathExistValidatorInterface;

readonly class DefinitionPathConfigContentValidator implements ConfigContentValidatorInterface
{
    public function __construct(
        private PathExistValidatorInterface $pathValidator,
    ) {
    }

    public function validate(ConfigContentTransfer $configContentTransfer): ValidatorMessageTransfer
    {
        return $this->pathValidator->validate($configContentTransfer->definitionPath);
    }
}
