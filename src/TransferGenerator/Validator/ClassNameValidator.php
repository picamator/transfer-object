<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\VariableValidatorTrait;

readonly class ClassNameValidator implements ClassNameValidatorInterface
{
    use VariableValidatorTrait;
    use ValidatorMessageTrait;

    private const string CLASS_NAME_ERROR_MESSAGE_TEMPLATE = 'Invalid class name "%s".';

    public function validate(?string $className): ValidatorMessageTransfer
    {
        if ($this->isValidVariable($className)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($className);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(?string $className): string
    {
        return sprintf(self::CLASS_NAME_ERROR_MESSAGE_TEMPLATE, $className ?? '');
    }
}
