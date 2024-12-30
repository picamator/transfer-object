<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ClassNameValidatorInterface;

readonly class ClassNameContentValidator implements ContentValidatorInterface
{
    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
    ) {
    }

    public function validate(DefinitionContentTransfer $contentTransfer): ValidatorMessageTransfer
    {
        return $this->classNameValidator->validate($contentTransfer->className);
    }
}
