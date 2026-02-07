<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Transfer\Attribute\Transformer;

use Attribute;
use DateTimeInterface;

/**
 * @api
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final readonly class DateTimeTransformerAttribute implements TransformerAttributeInterface
{
    use InvalidTypeAssertTrait;

    private const string DATE_TIME_FORMAT = DateTimeInterface::ATOM;

    /**
     * @param class-string<\DateTime|\DateTimeImmutable> $typeName
     */
    public function __construct(private string $typeName)
    {
    }

    public function fromArray(mixed $data): DateTimeInterface
    {
        $type = \gettype($data);
        if ($type === 'string') {
            /** @var string $data */
            return new $this->typeName($data);
        }

        if ($type === 'integer' || $type === 'double') {
            /** @var int|float $data */
            return $this->typeName::createFromTimestamp($data);
        }

        if ($type === 'object' && $data instanceof DateTimeInterface) {
            return $data;
        }

        $this->throwInvalidType($data);
    }

    /**
     * @param DateTimeInterface|null $data
     */
    public function toArray(mixed $data): ?string
    {
        return $data?->format(self::DATE_TIME_FORMAT);
    }
}
