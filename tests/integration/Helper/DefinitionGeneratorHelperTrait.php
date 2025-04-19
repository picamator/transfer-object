<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

trait DefinitionGeneratorHelperTrait
{
    /**
     * @throws \JsonException
     */
    protected function createDefinitionGenerator(
        string $definitionPath,
        string $className,
        string $sampleJsonPath,
    ): DefinitionGeneratorTransfer {
        $sampleContent = $this->getSampleContent($sampleJsonPath);

        return new DefinitionGeneratorTransfer()
            ->fromArray([
                DefinitionGeneratorTransfer::DEFINITION_PATH => $definitionPath,
                DefinitionGeneratorTransfer::CONTENT => [
                    DefinitionGeneratorContentTransfer::CLASS_NAME => $className,
                    DefinitionGeneratorContentTransfer::CONTENT => $sampleContent,
                ],
            ]);
    }

    /**
     * @throws \JsonException
     *
     * @return array<string,mixed>
     */
    protected function getSampleContent(string $sampleJsonPath): array
    {
        $content = file_get_contents($sampleJsonPath);
        if ($content === false) {
            return [];
        }

        /** @var array<string,mixed> $decodedContent */
        $decodedContent = json_decode($content, true, flags: JSON_THROW_ON_ERROR);

        return $decodedContent;
    }
}
