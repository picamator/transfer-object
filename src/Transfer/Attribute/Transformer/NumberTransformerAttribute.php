<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Attribute;
use BcMath\Number;
use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class NumberTransformerAttribute implements TransformerAttributeInterface
{
    /**
     * @param class-string<\BcMath\Number> $typeName
     */
    public function __construct(private string $typeName)
    {
    }

    public function fromArray(mixed $data): Number
    {
        if (\is_float($data)) {
            return new $this->typeName((string)$data);
        }

        if (\is_numeric($data)) {
            return new $this->typeName($data);
        }

        if ($data instanceof Number) {
            return $data;
        }

        $this->assertInvalidType($data);
    }

    /**
     * @param \BcMath\Number|null $data
     */
    public function toArray(mixed $data): ?string
    {
        return $data?->__toString();
    }

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\DataAssertTransferException
     */
    private function assertInvalidType(mixed $data): never
    {
        throw new DataAssertTransferException(
            \sprintf(
                'Data must be of type %s, "%s" given.',
                $this->typeName,
                \get_debug_type($data),
            ),
        );
    }
}
