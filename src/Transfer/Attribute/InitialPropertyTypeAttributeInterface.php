<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

/**
 * @api
 */
interface InitialPropertyTypeAttributeInterface extends PropertyTypeAttributeInterface
{
    /**
     * @return iterable<mixed>
     */
    public function getInitialValue(): iterable;
}
