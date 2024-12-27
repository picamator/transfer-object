<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class TransferNamespaceConfigValidator implements ConfigValidatorInterface
{
    use ValidatorMessageTrait;

    private const string NAMESPACE_REGEX = '#^(?:[A-Z][a-zA-Z0-9_]*\\\\)*[A-Z][a-zA-Z0-9_]*$#';

    private const string ERROR_MESSAGE_TEMPLATE = 'Invalid configuration namespace "%s".';

    public function validate(ConfigTransfer $configTransfer): ValidatorMessageTransfer
    {
        $namespace = $configTransfer->transferNamespace ?? '';
        if (preg_match(self::NAMESPACE_REGEX, $namespace) !== 1) {
            $errorMessage = $this->getErrorMessage($namespace);

            return $this->createErrorMessageTransfer($errorMessage);
        }

        return $this->createSuccessMessageTransfer();
    }

    private function getErrorMessage(string $namespace): string
    {
        return sprintf(self::ERROR_MESSAGE_TEMPLATE, $namespace);
    }
}
