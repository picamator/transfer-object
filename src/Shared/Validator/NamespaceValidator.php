<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Validator;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

class NamespaceValidator implements NamespaceValidatorInterface
{
    use ValidatorMessageTrait;
    use NamespaceValidatorTrait;

    private const string INVALID_NAMESPACE_ERROR_MESSAGE_TEMPLATE = 'Invalid namespace "%s".';

    public function validate(?string $namespace): ValidatorMessageTransfer
    {
        if ($this->isValidNamespace($namespace)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($namespace);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(?string $namespace): string
    {
        return sprintf(self::INVALID_NAMESPACE_ERROR_MESSAGE_TEMPLATE, $namespace ?: '');
    }
}
