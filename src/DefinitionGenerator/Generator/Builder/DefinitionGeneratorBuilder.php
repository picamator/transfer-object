<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;
use Picamator\TransferObject\Shared\Reader\JsonReaderInterface;
use Picamator\TransferObject\Shared\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathValidatorInterface;
use Throwable;

class DefinitionGeneratorBuilder implements DefinitionGeneratorBuilderInterface
{
    private DefinitionGeneratorTransfer $generatorTransfer;

    public function __construct(
        private readonly PathValidatorInterface $pathValidator,
        private readonly ClassNameValidatorInterface $classNameValidator,
        private readonly JsonReaderInterface $jsonReader,
    ) {
    }

    public function setDefinitionPath(string $definitionPath): self
    {
        $definitionPath = rtrim($definitionPath, '\/');
        $messageTransfer = $this->pathValidator->validate($definitionPath);

        if ($messageTransfer->isValid) {
            $this->getGeneratorTransfer()->definitionPath = $definitionPath;

            return $this;
        }

        throw new DefinitionGeneratorException($messageTransfer->errorMessage);
    }

    public function setClassName(string $className): self
    {
        $messageTransfer = $this->classNameValidator->validate($className);

        if ($messageTransfer->isValid) {
            $this->getGeneratorTransfer()->content->className = $className;

            return $this;
        }

        throw new DefinitionGeneratorException($messageTransfer->errorMessage);
    }

    public function setJsonPath(string $jsonPath): self
    {
        try {
            $content = $this->jsonReader->getJsonContent($jsonPath);
            $this->getGeneratorTransfer()->content->content = $content;
        } catch (Throwable $e) {
            throw new DefinitionGeneratorException($e->getMessage());
        }

        return $this;
    }

    public function build(): DefinitionGeneratorTransfer
    {
        $generatorTransfer = $this->getGeneratorTransfer();
        unset($this->generatorTransfer);

        return $generatorTransfer;
    }

    private function getGeneratorTransfer(): DefinitionGeneratorTransfer
    {
        if (isset($this->generatorTransfer)) {
            return $this->generatorTransfer;
        }

        $generatorTransfer = new DefinitionGeneratorTransfer();
        $generatorTransfer->content = new DefinitionGeneratorContentTransfer();

        return $this->generatorTransfer = $generatorTransfer;
    }
}
