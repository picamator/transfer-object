<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

interface PropertyTypeAttributeInterface
{
    public function fromArray(mixed $data): mixed;

    public function toArray(mixed $data): mixed;
}
