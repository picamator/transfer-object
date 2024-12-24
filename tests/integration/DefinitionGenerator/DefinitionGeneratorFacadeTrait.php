<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator;

use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

trait DefinitionGeneratorFacadeTrait
{
    private const string SAMPLE_FILE_PATH = __DIR__ . '/data/json-samples/';
    protected const string DEFINITION_PATH = __DIR__ . '/data/config/definition';

    protected function createDefinitionGenerator(string $className, string $sampleFileName): DefinitionGeneratorTransfer
    {
        $sampleContent = $this->getSampleContent($sampleFileName);

        return new DefinitionGeneratorTransfer()
            ->fromArray([
                DefinitionGeneratorTransfer::DEFINITION_PATH => self::DEFINITION_PATH,
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
    private function getSampleContent(string $sampleFileName): array
    {
        $filePath = self::SAMPLE_FILE_PATH . $sampleFileName;
        $content = file_get_contents($filePath);
        if ($content === false) {
            return [];
        }

        return json_decode($content, true, flags: JSON_THROW_ON_ERROR);
    }
}
