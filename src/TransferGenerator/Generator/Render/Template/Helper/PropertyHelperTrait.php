<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper;

/**
 * @property \Picamator\TransferObject\Generated\TemplateTransfer $templateTransfer
 */
trait PropertyHelperTrait
{
    private const string NULLABLE_TYPE = '?';
    private const string NULLABLE_UNION = 'null|';
    private const string PROTECTED_SET = ' protected(set)';

    public function renderPropertyDeclaration(string $property): string
    {
        /** @var string $propertyType */
        $propertyType = $this->templateTransfer->properties[$property];

        return "{$this->renderProtected($property)} {$this->renderNullable($property)}$propertyType";
    }

    public function renderNullable(string $property): string
    {
        /** @var string $propertyType */
        $propertyType = $this->templateTransfer->properties[$property];
        $isNullable = $this->templateTransfer->nullables[$property];

        if (!$isNullable || str_contains($propertyType, '&')) {
            return '';
        }

        if (str_contains($propertyType, '|')) {
            return self::NULLABLE_UNION;
        }

        return self::NULLABLE_TYPE;
    }

    private function renderProtected(string $property): string
    {
        return $this->templateTransfer->protects[$property] ? self::PROTECTED_SET : '';
    }
}
