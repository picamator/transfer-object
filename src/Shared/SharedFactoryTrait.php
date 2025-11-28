<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared;

use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Shared\Filesystem\FileAppender;
use Picamator\TransferObject\Shared\Filesystem\FileAppenderInterface;
use Picamator\TransferObject\Shared\Filesystem\FileReader;
use Picamator\TransferObject\Shared\Filesystem\FileReaderInterface;
use Picamator\TransferObject\Shared\Initializer\LazyGhostInitializerTrait;
use Picamator\TransferObject\Shared\Reader\FileReaderProgress;
use Picamator\TransferObject\Shared\Reader\FileReaderProgressInterface;
use Picamator\TransferObject\Shared\Reader\JsonReader;
use Picamator\TransferObject\Shared\Reader\JsonReaderInterface;
use Picamator\TransferObject\Shared\Validator\ClassNameValidator;
use Picamator\TransferObject\Shared\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Shared\Validator\NamespaceValidator;
use Picamator\TransferObject\Shared\Validator\NamespaceValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathExistValidator;
use Picamator\TransferObject\Shared\Validator\PathExistValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathLocalValidator;
use Picamator\TransferObject\Shared\Validator\PathLocalValidatorInterface;

trait SharedFactoryTrait
{
    use DependencyFactoryTrait;
    use CachedFactoryTrait;
    use LazyGhostInitializerTrait;

    final protected function createFileAppender(): FileAppenderInterface
    {
        return $this->getCached(
            key: 'shared:FileAppender',
            factory: fn(): FileAppenderInterface => new FileAppender(),
        );
    }

    final protected function createJsonReader(): JsonReaderInterface
    {
        return $this->getCached(
            key: 'shared:JsonReader',
            factory: fn(): JsonReaderInterface => new JsonReader($this->createFilesystem()),
        );
    }

    final protected function createClassNameValidator(): ClassNameValidatorInterface
    {
        return $this->getCached(
            key: 'shared:ClassNameValidator',
            factory: fn(): ClassNameValidatorInterface => new ClassNameValidator(),
        );
    }

    final protected function createNamespaceValidator(): NamespaceValidatorInterface
    {
        return $this->getCached(
            key: 'shared:NamespaceValidator',
            factory: fn(): NamespaceValidatorInterface => new NamespaceValidator(),
        );
    }

    final protected function createPathExistValidator(): PathExistValidatorInterface
    {
        return $this->getCached(
            key: 'shared:PathExistValidator',
            factory: fn(): PathExistValidatorInterface => new PathExistValidator($this->createFilesystem()),
        );
    }

    final protected function createPathLocalValidator(): PathLocalValidatorInterface
    {
        return $this->getCached(
            key: 'shared:PathLocalValidator',
            factory: fn(): PathLocalValidatorInterface => new PathLocalValidator(),
        );
    }

    final protected function createFileReaderProgress(): FileReaderProgressInterface
    {
        return $this->getCached(
            key: 'shared:FileReaderProgress',
            factory: fn(): FileReaderProgressInterface => new FileReaderProgress($this->createFileReader()),
        );
    }

    final protected function createFileReader(): FileReaderInterface
    {
        return $this->getCached(
            key: 'shared:FileReader',
            factory: fn(): FileReaderInterface => new FileReader(),
        );
    }
}
