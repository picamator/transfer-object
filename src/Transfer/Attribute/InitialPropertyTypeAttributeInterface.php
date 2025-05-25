<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

/**
 * @api
 */
interface InitialPropertyTypeAttributeInterface extends PropertyTypeAttributeInterface
{
    public function getInitialValue(): mixed;
}
