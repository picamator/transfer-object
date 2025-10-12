<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Initiator;

use Attribute;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class ArrayInitiatorAttribute implements InitiatorAttributeInterface
{
    /**
     * @return array<string|int,mixed>
     */
    public function getInitialValue(): array
    {
        return [];
    }
}
