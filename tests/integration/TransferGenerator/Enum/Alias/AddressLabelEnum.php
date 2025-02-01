<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Enum\Alias;

enum AddressLabelEnum: string
{
    case FAMILY = 'Family';
    case FRIENDS = 'Friends';
    case BUSINESS = 'Business';
    case OTHER = 'Other';
}
