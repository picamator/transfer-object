<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Builder;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Render\ProjectRootRenderInterface;

readonly class ConfigContentBuilder implements ConfigContentBuilderInterface
{
    public function __construct(private ProjectRootRenderInterface $environmentRender)
    {
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
