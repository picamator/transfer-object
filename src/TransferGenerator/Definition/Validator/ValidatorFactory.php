<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator;

use ArrayObject;
use Picamator\TransferObject\Shared\CachedFactoryTrait;
use Picamator\TransferObject\Shared\SharedFactoryTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\ClassNameContentValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\ContentValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\EmptyPropertiesContentValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\PropertiesContentValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\BuildInTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\CollectionTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\DateTimeTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\EnumTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\NamePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\NumberTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\PropertyValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\RequiredTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\ReservedNamePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\TransferTypePropertyValidator;

class ValidatorFactory
{
    use SharedFactoryTrait;
    use CachedFactoryTrait;

    public function createDefinitionValidator(): DefinitionValidatorInterface
    {
        /** @phpstan-ignore return.type */
        return $this->getCached(
            key: 'definition-validator',
            factory: fn (): DefinitionValidatorInterface =>
                new DefinitionValidator(
                    $this->createContentValidators(),
                ),
        );
    }

    /**
     * @return \ArrayObject<int,ContentValidatorInterface>
     */
    protected function createContentValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createClassNameContentValidator(),
            $this->createEmptyPropertiesContentValidator(),
            $this->createPropertiesContentValidator(),
        ]);
    }

    protected function createPropertiesContentValidator(): ContentValidatorInterface
    {
        return new PropertiesContentValidator($this->createPropertyValidators());
    }

    /**
     * @return \ArrayObject<int,PropertyValidatorInterface>
     */
    protected function createPropertyValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createReservedNamePropertyValidator(),
            $this->createNamePropertyValidator(),
            $this->createRequiredTypePropertyValidator(),
            $this->createBuildInTypePropertyValidator(),
            $this->createTransferTypePropertyValidator(),
            $this->createCollectionTypePropertyValidator(),
            $this->createEnumTypePropertyValidator(),
            $this->createDateTimeTypePropertyValidator(),
            $this->createNumberTypePropertyValidator(),
        ]);
    }

    protected function createNumberTypePropertyValidator(): PropertyValidatorInterface
    {
        return new NumberTypePropertyValidator();
    }

    protected function createDateTimeTypePropertyValidator(): PropertyValidatorInterface
    {
        return new DateTimeTypePropertyValidator();
    }

    protected function createEnumTypePropertyValidator(): PropertyValidatorInterface
    {
        return new EnumTypePropertyValidator();
    }

    protected function createCollectionTypePropertyValidator(): PropertyValidatorInterface
    {
        return new CollectionTypePropertyValidator(
            $this->createClassNameValidator(),
            $this->createNamespaceValidator(),
        );
    }

    protected function createTransferTypePropertyValidator(): PropertyValidatorInterface
    {
        return new TransferTypePropertyValidator(
            $this->createClassNameValidator(),
            $this->createNamespaceValidator(),
        );
    }

    protected function createBuildInTypePropertyValidator(): PropertyValidatorInterface
    {
        return new BuildInTypePropertyValidator();
    }

    protected function createRequiredTypePropertyValidator(): PropertyValidatorInterface
    {
        return new RequiredTypePropertyValidator();
    }

    protected function createNamePropertyValidator(): PropertyValidatorInterface
    {
        return new NamePropertyValidator();
    }

    protected function createReservedNamePropertyValidator(): PropertyValidatorInterface
    {
        return new ReservedNamePropertyValidator();
    }

    protected function createEmptyPropertiesContentValidator(): ContentValidatorInterface
    {
        return new EmptyPropertiesContentValidator();
    }

    protected function createClassNameContentValidator(): ContentValidatorInterface
    {
        return new ClassNameContentValidator($this->createClassNameValidator());
    }
}
