<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared;

use Picamator\TransferObject\Dependency\DependencyFactoryTrait;
use Picamator\TransferObject\Shared\Filesystem\FileAppender;
use Picamator\TransferObject\Shared\Filesystem\FileAppenderInterface;
use Picamator\TransferObject\Shared\Filesystem\FileReader;
use Picamator\TransferObject\Shared\Filesystem\FileReaderInterface;
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

    final protected function createFileAppender(): FileAppenderInterface
    {
        return new FileAppender();
    }

    final protected function createJsonReader(): JsonReaderInterface
    {
        return new JsonReader($this->createFilesystem());
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
        return new PathExistValidator($this->createFilesystem());
    }

    final protected function createPathLocalValidator(): PathLocalValidatorInterface
    {
        return new PathLocalValidator();
    }

    final protected function createFileReaderProgress(): FileReaderProgressInterface
    {
        return new FileReaderProgress($this->createFileReader());
    }

    final protected function createFileReader(): FileReaderInterface
    {
        return new FileReader();
    }
}
