<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class PropertyAttribute
{
    public function __construct(protected string $property)
    {
    }
}
