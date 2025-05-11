<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared;

use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Shared\Filesystem\FileAppender;
use Picamator\TransferObject\Shared\Filesystem\FileAppenderInterface;
use Picamator\TransferObject\Shared\Reader\JsonReader;
use Picamator\TransferObject\Shared\Reader\JsonReaderInterface;
use Picamator\TransferObject\Shared\Validator\ClassNameValidator;
use Picamator\TransferObject\Shared\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathLocalValidator;
use Picamator\TransferObject\Shared\Validator\PathLocalValidatorInterface;
use Picamator\TransferObject\Shared\Validator\NamespaceValidator;
use Picamator\TransferObject\Shared\Validator\NamespaceValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathExistValidator;
use Picamator\TransferObject\Shared\Validator\PathExistValidatorInterface;

trait SharedFactoryTrait
{
    use DependencyFactoryTrait;

    final protected function createFileAppender(): FileAppenderInterface
    {
        return new FileAppender();
    }

    final protected function createJsonReader(): JsonReaderInterface
    {
        return new JsonReader($this->getFilesystem());
    }

    final protected function createClassNameValidator(): ClassNameValidatorInterface
    {
        return new ClassNameValidator();
    }

    final protected function createNamespaceValidator(): NamespaceValidatorInterface
    {
        return new NamespaceValidator();
    }

    final protected function createPathExistValidator(): PathExistValidatorInterface
    {
        return new PathExistValidator($this->getFilesystem());
    }

    final protected function createPathLocalValidator(): PathLocalValidatorInterface
    {
        return new PathLocalValidator();
    }
}
