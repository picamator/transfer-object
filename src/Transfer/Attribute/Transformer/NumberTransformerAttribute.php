<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Attribute;
use BcMath\Number;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class NumberTransformerAttribute implements TransformerAttributeInterface
{
    use DataAssertTrait;

    /**
     * @param class-string<\BcMath\Number> $typeName
     */
    public function __construct(private string $typeName)
    {
    }

    public function fromArray(mixed $data): Number
    {
        return match (true) {
            is_float($data) => new $this->typeName((string)$data),

            is_string($data) || is_int($data) => new $this->typeName($data),

            $data instanceof Number => $data,

            default => $this->assertInvalidType($data, $this->typeName),
        };
    }

    /**
     * @param \BcMath\Number|null $data
     */
    public function toArray(mixed $data): ?string
    {
        return $data?->__toString();
    }
}
