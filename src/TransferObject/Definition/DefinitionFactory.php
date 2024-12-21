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
use Picamator\TransferObject\Definition\Validator\Property\BuildInTypePropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\CollectionTypePropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\NamePropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\PropertyValidatorInterface;
use Picamator\TransferObject\Definition\Validator\Property\RequiredUniqueTypePropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\ReservedPropertyValidator;
use Picamator\TransferObject\Definition\Validator\Property\TransferTypePropertyValidator;
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
            $this->createPropertyValidators(),
        );
    }

    /**
     * @return ArrayObject<int,\Picamator\TransferObject\Definition\Validator\Property\PropertyValidatorInterface>
     */
    protected function createPropertyValidators(): ArrayObject
    {
        return new ArrayObject([
            $this->createNamePropertyValidator(),
            $this->createReservedPropertyValidator(),
            $this->createRequiredUniqueTypePropertyValidator(),
            $this->createBuildInTypePropertyValidator(),
            $this->createTransferTypePropertyValidator(),
            $this->createCollectionTypePropertyValidator(),
        ]);
    }

    protected function createCollectionTypePropertyValidator(): PropertyValidatorInterface
    {
        return new CollectionTypePropertyValidator($this->createClassNameValidator());
    }

    protected function createTransferTypePropertyValidator(): PropertyValidatorInterface
    {
        return new TransferTypePropertyValidator($this->createClassNameValidator());
    }

    protected function createBuildInTypePropertyValidator(): PropertyValidatorInterface
    {
        return new BuildInTypePropertyValidator();
    }

    protected function createRequiredUniqueTypePropertyValidator(): PropertyValidatorInterface
    {
        return new RequiredUniqueTypePropertyValidator();
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
