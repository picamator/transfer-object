<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Initiator;

use ArrayObject;
use Attribute;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class ArrayObjectInitiatorAttribute implements InitiatorAttributeInterface
{
    /**
     * @return \ArrayObject<string|int,mixed>
     */
    public function getInitialValue(): ArrayObject
    {
        return new ArrayObject();
    }
}
