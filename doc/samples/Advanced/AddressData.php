<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Advanced;

use Picamator\TransferObject\Transfer\TransferAdapterTrait;
use Picamator\TransferObject\Transfer\TransferInterface;

class AddressData implements TransferInterface
{
    use TransferAdapterTrait;

    public function __construct(
        public ?string $street = null,
        public ?string $houseNumber = null,
        public ?string $city = null,
        public ?string $postCode = null,
        public ?string $country = null,
    ) {
    }
}
