<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator;

use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class ClassNameValidator implements ClassNameValidatorInterface
{
    use VariableValidatorTrait;

    private const string CLASS_NAME_ERROR_MESSAGE_TEMPLATE = 'Invalid class "%s" name.';

    public function validate(?string $className): ValidatorMessageTransfer
    {
        $validatorTransfer = new ValidatorMessageTransfer();

        if ($this->isValidVariable($className)) {
            $validatorTransfer->isValid = true;

            return $validatorTransfer;
        }

        $validatorTransfer->errorMessage = $this->getErrorMessage($className);
        $validatorTransfer->isValid = false;

        return $validatorTransfer;
    }

    private function getErrorMessage(?string $className): string
    {
        return sprintf(self::CLASS_NAME_ERROR_MESSAGE_TEMPLATE, $className ?? '');
    }
}
