<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;
use BcMath\Number;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class NumberPropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    use DataAssertTrait;

    public function __construct(private string $typeName)
    {
    }

    public function fromArray(mixed $data): Number
    {
        /** @var \BcMath\Number $dateTime */
        $dateTime = match (true) {
            is_string($data) || is_int($data) => new $this->typeName($data),
            $data instanceof Number => $data,
            default => $this->assertInvalidType($data, $this->typeName),
        };

        return $dateTime;
    }

    /**
     * @param \BcMath\Number|null $data
     */
    public function toArray(mixed $data): ?string
    {
        return $data?->__toString();
    }
}
