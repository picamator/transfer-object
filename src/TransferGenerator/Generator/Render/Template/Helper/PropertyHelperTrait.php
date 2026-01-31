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

        return "{$this->renderProtected($property)} {$this->renderRequired($property)}$propertyType";
    }

    public function renderRequired(string $property): string
    {
        /** @var string $propertyType */
        $propertyType = $this->templateTransfer->properties[$property];
        $isRequired = $this->templateTransfer->requires[$property] ?? false;

        if ($isRequired || str_contains($propertyType, '&')) {
            return '';
        }

        if (str_contains($propertyType, '|')) {
            return self::NULLABLE_UNION;
        }

        return self::NULLABLE_TYPE;
    }

    private function renderProtected(string $property): string
    {
        $isProtected = $this->templateTransfer->protects[$property] ?? false;

        return $isProtected ? self::PROTECTED_SET : '';
    }
}
