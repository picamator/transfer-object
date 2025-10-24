<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

enum DefinitionKeyEnum: string
{
    case TYPE = 'type';
    case COLLECTION_TYPE = 'collectionType';
    case ENUM_TYPE = 'enumType';
    case DATE_TIME_TYPE = 'dateTimeType';
    case NUMBER_TYPE = 'numberType';

    case REQUIRED = 'required';
    case PROTECTED = 'protected';

    case ATTRIBUTES = 'attributes';

    /**
     * @return string|array<int,string>|null
     */
    public function normalizeValue(mixed $value): string|array|null
    {
        return match (true) {
            is_string($value) => $this->normalizeString($value),
            is_bool($value) => $this->normalizeBool($value),
            is_array($value) => $this->normalizeArray($value),
            default => null,
        };
    }

    /**
     * @param array<int|string,mixed> $value
     *
     * @return array<int,string>|null
     */
    private function normalizeArray(array $value): ?array
    {
        if ($this !== self::ATTRIBUTES) {
            return null;
        }

        /** @var array<int,string> $value */
        $value = array_filter(
            array: $value,
            callback: fn (mixed $value, int|string $key): bool => is_string($value) && is_int($key),
            mode: ARRAY_FILTER_USE_BOTH,
        );

        return $value;
    }

    private function normalizeBool(bool $value): ?string
    {
        if ($this !== self::TYPE) {
            return null;
        }

        return $value === true ? 'true' : 'false';
    }

    private function normalizeString(string $value): ?string
    {
        if ($this === self::REQUIRED || $this === self::PROTECTED) {
            return null;
        }

        return trim($value);
    }
}
