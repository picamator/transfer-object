<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Initiator;

/**
 * @api
 */
interface InitiatorAttributeInterface
{
    /**
     * @return iterable<mixed>
     */
    public function getInitialValue(): iterable;
}
