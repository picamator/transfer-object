<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute;

use Attribute;
use DateTimeInterface;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class DateTimePropertyTypeAttribute implements PropertyTypeAttributeInterface
{
    use DataAssertTrait;

    private const string DATE_TIME_FORMAT = DateTimeInterface::ATOM;

    /**
     * @param class-string<\DateTime|\DateTimeImmutable> $typeName
     */
    public function __construct(private string $typeName)
    {
    }

    public function fromArray(mixed $data): DateTimeInterface
    {
        return match (true) {
            is_string($data) => new $this->typeName($data),

            is_int($data) || is_float($data) => $this->typeName::createFromTimestamp($data),

            $data instanceof DateTimeInterface => $data,

            default => $this->assertInvalidType($data, $this->typeName),
        };
    }

    /**
     * @param DateTimeInterface|null $data
     */
    public function toArray(mixed $data): ?string
    {
        return $data?->format(self::DATE_TIME_FORMAT);
    }
}
