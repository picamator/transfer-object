<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;
use Picamator\TransferObject\Shared\Reader\JsonReaderInterface;
use Picamator\TransferObject\Shared\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathLocalValidatorInterface;

class DefinitionGeneratorBuilder implements DefinitionGeneratorBuilderInterface
{
    private DefinitionGeneratorTransfer $generatorTransfer;

    public function __construct(
        private readonly PathLocalValidatorInterface $pathLocalValidator,
        private readonly ClassNameValidatorInterface $classNameValidator,
        private readonly JsonReaderInterface $jsonReader,
    ) {
    }

    public function setDefinitionPath(string $definitionPath): self
    {
        $messageTransfer = $this->pathLocalValidator->validate($definitionPath);

        if ($messageTransfer === null) {
            $definitionPath = rtrim($definitionPath, '\/');
            $this->getGeneratorTransfer()->definitionPath = $definitionPath;

            return $this;
        }

        throw new DefinitionGeneratorException($messageTransfer->errorMessage);
    }

    public function setClassName(string $className): self
    {
        $messageTransfer = $this->classNameValidator->validate($className);

        if ($messageTransfer === null) {
            $this->getGeneratorTransfer()->content->className = $className;

            return $this;
        }

        throw new DefinitionGeneratorException($messageTransfer->errorMessage);
    }

    public function setJsonPath(string $jsonPath): self
    {
        $content = $this->jsonReader->getJsonContent($jsonPath);
        $this->getGeneratorTransfer()->content->content = $content;

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
