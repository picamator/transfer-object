<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator\Content;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\NamespaceValidatorTrait;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

class TransferNamespaceContentValidator implements ContentValidatorInterface
{
    use ValidatorMessageTrait;
    use NamespaceValidatorTrait;

    private const string ERROR_MESSAGE_TEMPLATE = 'Invalid configuration namespace "%s".';

    public function validate(ConfigContentTransfer $configContentTransfer): ValidatorMessageTransfer
    {
        $namespace = $configContentTransfer->transferNamespace;
        if ($this->isValidNamespace($namespace)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($namespace);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(string $namespace): string
    {
        return sprintf(self::ERROR_MESSAGE_TEMPLATE, $namespace);
    }
}
