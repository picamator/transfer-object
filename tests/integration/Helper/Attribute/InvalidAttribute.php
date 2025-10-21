<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper\Attribute;

class InvalidAttribute
{
    public function __construct(protected string $property)
    {
    }
}
