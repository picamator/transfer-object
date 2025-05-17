<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content;

use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

class EmptyPropertiesContentValidator implements ContentValidatorInterface
{
    use ValidatorMessageTrait;

    private const string PROPERTY_ERROR_MESSAGE_TEMPLATE = 'Class "%s" properties were not defined.';

    public function validate(DefinitionContentTransfer $contentTransfer): ValidatorMessageTransfer
    {
        if ($contentTransfer->properties->count() > 0) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($contentTransfer->className);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(?string $className): string
    {
        return sprintf(self::PROPERTY_ERROR_MESSAGE_TEMPLATE, $className ?? '');
    }
}
