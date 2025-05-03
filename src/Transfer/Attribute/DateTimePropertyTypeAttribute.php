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

    protected const string DATE_TIME_FORMAT = DateTimeInterface::ATOM;

    public function __construct(private string $typeName)
    {
    }

    public function fromArray(mixed $data): DateTimeInterface
    {
        /** @var DateTimeInterface $dateTime */
        $dateTime = match (true) {
            is_string($data) => new $this->typeName($data),
            $data instanceof DateTimeInterface => $data,
            default => $this->assertInvalidType($data, $this->typeName),
        };

        return $dateTime;
    }

    /**
     * @param DateTimeInterface|null $data
     */
    public function toArray(mixed $data): ?string
    {
        return $data?->format(self::DATE_TIME_FORMAT);
    }

    public function getInitialValue(): null
    {
        return null;
    }
}
