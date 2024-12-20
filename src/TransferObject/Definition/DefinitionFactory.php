<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition;

use ArrayObject;
use Picamator\TransferObject\Config\ConfigFactoryTrait;
use Picamator\TransferObject\Definition\Filesystem\DefinitionFinder;
use Picamator\TransferObject\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\Definition\Parser\ContentParserInterface;
use Picamator\TransferObject\Definition\Parser\YmlContentParser;
use Picamator\TransferObject\Definition\Reader\DefinitionReader;
use Picamator\TransferObject\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\Definition\Validator\ClassNameValidator;
use Picamator\TransferObject\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Definition\Validator\ContentValidator;
use Picamator\TransferObject\Definition\Validator\ContentValidatorInterface;
use Picamator\TransferObject\Definition\Validator\Property\CollectionTypePropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\DefinitionPropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\NamePropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\PropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\PropertyValidatorInterface;
use Picamator\TransferObject\Definition\Validator\Property\ReservedPropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\TypePropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\UnionTypePropertyValidator;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Parser;

readonly class DefinitionFactory
{
    use ConfigFactoryTrait;
    use DependencyFactoryTrait;

    public function createDefinitionReader(): DefinitionReaderInterface
    {
        return new DefinitionReader(
            $this->createDefinitionFinder(),
            $this->createContentParser(),
            $this->createContentValidator(),
        );
    }

    protected function createContentValidator(): ContentValidatorInterface
    {
        return new ContentValidator(
            $this->createClassNameValidator(),
            $this->createPropertyValidator(),
        );
    }

    protected function createPropertyValidator(): PropertyValidatorInterface
    {
        return new PropertyValidator($this->createPropertyValidators());
    }

    /**
     * @return ArrayObject<\Picamator\TransferObject\Definition\Validator\Property\PropertyValidatorInterface>
     */
    protected function createPropertyValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createNamePropertyValidator(),
            $this->createReservedPropertyValidator(),
            $this->createDefinitionPropertyValidator(),
            $this->createUnionTypePropertyValidator(),
            $this->createTypePropertyValidator(),
            $this->createCollectionTypePropertyValidator(),
        ]);
    }

    protected function createCollectionTypePropertyValidator(): PropertyValidatorInterface
    {
        return new CollectionTypePropertyValidator($this->createClassNameValidator());
    }

    protected function createTypePropertyValidator(): PropertyValidatorInterface
    {
        return new TypePropertyValidator($this->createClassNameValidator());
    }

    protected function createUnionTypePropertyValidator(): PropertyValidatorInterface
    {
        return new UnionTypePropertyValidator();
    }

    protected function createDefinitionPropertyValidator(): PropertyValidatorInterface
    {
        return new DefinitionPropertyValidator();
    }

    protected function createReservedPropertyValidator(): PropertyValidatorInterface
    {
        return new ReservedPropertyValidator();
    }

    protected function createNamePropertyValidator(): PropertyValidatorInterface
    {
        return new NamePropertyValidator();
    }

    protected function createClassNameValidator(): ClassNameValidatorInterface
    {
        return new ClassNameValidator();
    }

    protected function createContentParser(): ContentParserInterface
    {
        return new YmlContentParser($this->createYmlParser());
    }

    protected function createYmlParser(): Parser
    {
        return $this->getDependency(DependencyContainer::YML_PARSER);
    }

    protected function createDefinitionFinder(): DefinitionFinderInterface
    {
        return new DefinitionFinder(
            $this->createFinder(),
            $this->getConfig(),
        );
    }

    protected function createFinder(): Finder
    {
        return $this->getDependency(DependencyContainer::FINDER);
    }
}
