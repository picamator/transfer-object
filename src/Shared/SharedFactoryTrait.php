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
use Picamator\TransferObject\Shared\Validator\NamespaceValidator;
use Picamator\TransferObject\Shared\Validator\NamespaceValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathValidator;
use Picamator\TransferObject\Shared\Validator\PathValidatorInterface;

trait SharedFactoryTrait
{
    use DependencyFactoryTrait;

    protected function createFileAppender(): FileAppenderInterface
    {
        return new FileAppender();
    }

    protected function createJsonReader(): JsonReaderInterface
    {
        return new JsonReader($this->getFilesystem());
    }

    protected function createClassNameValidator(): ClassNameValidatorInterface
    {
        return new ClassNameValidator();
    }

    protected function createNamespaceValidator(): NamespaceValidatorInterface
    {
        return new NamespaceValidator();
    }

    protected function createPathValidator(): PathValidatorInterface
    {
        return new PathValidator($this->getFilesystem());
    }
}
