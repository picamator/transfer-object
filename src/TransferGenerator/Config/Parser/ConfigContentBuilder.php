<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Environment\ConfigEnvironmentRenderInterface;

readonly class ConfigContentBuilder implements ConfigContentBuilderInterface
{
    public function __construct(
        private ConfigEnvironmentRenderInterface $environmentRender,
    ) {
    }

    public function createContentTransfer(array $configData): ConfigContentTransfer
    {
        $contentTransfer = new ConfigContentTransfer($configData);

        return $this->renderPathKeys($contentTransfer);
    }

    private function renderPathKeys(ConfigContentTransfer $contentTransfer): ConfigContentTransfer
    {
        $contentTransfer->relativeDefinitionPath =
            $this->environmentRender->renderRelativeProjectRoot($contentTransfer->definitionPath);

        $contentTransfer->definitionPath =
            $this->environmentRender->renderProjectRoot($contentTransfer->definitionPath);

        $contentTransfer->transferPath =
            $this->environmentRender->renderProjectRoot($contentTransfer->transferPath);

        return $contentTransfer;
    }
}
