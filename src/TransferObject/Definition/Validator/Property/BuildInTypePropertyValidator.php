<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Enum\BlackListBuildInTypeEnum;
use Picamator\TransferObject\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class BuildInTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string PROPERTY_TYPE_UNSUPPORTED_ERROR_MESSAGE_TEMPLATE = 'Property "%s" type "%s" is not supported.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->buildInType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if (!BlackListBuildInTypeEnum::isBackListed($propertyTransfer->buildInType)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::PROPERTY_TYPE_UNSUPPORTED_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->buildInType ?? '',
        );
    }
}
