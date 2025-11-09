<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Builder;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;
use Picamator\TransferObject\TransferGenerator\Config\Enum\ConfigKeyEnum;
use Throwable;

readonly class ConfigBuilder implements ConfigBuilderInterface
{
    use ValidatorTrait;

    public function createConfigTransfer(
        ValidatorTransfer $validatorTransfer,
        ?ConfigContentTransfer $contentTransfer = null,
    ): ConfigTransfer {
        $contentTransfer ??= $this->createDefaultContentTransfer();

        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = $validatorTransfer;
        $configTransfer->content = $contentTransfer;

        return $configTransfer;
    }

    public function createErrorConfigTransfer(Throwable $e): ConfigTransfer
    {
        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = $this->createErrorValidatorTransfer($e->getMessage());
        $configTransfer->content = $this->createDefaultContentTransfer();

        return $configTransfer;
    }

    private function createDefaultContentTransfer(): ConfigContentTransfer
    {
        return new ConfigContentTransfer(ConfigKeyEnum::getDefaultConfig());
    }
}
