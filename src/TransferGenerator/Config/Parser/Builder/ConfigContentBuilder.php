<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Builder;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Enum\ConfigKeyEnum;
use Picamator\TransferObject\TransferGenerator\Config\Environment\ConfigEnvironmentRenderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Filter\ConfigNormalizerTrait;

readonly class ConfigContentBuilder implements ConfigContentBuilderInterface
{
    use ConfigNormalizerTrait;

    public function __construct(
        private ConfigEnvironmentRenderInterface $environmentRender,
    ) {
    }

    public function createDefaultContentTransfer(): ConfigContentTransfer
    {
        return new ConfigContentTransfer(ConfigKeyEnum::getDefaultConfig());
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
