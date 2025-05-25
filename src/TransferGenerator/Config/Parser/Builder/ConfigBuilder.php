<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Builder;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorTrait;

readonly class ConfigBuilder implements ConfigBuilderInterface
{
    use ValidatorTrait;

    public function __construct(
        private ConfigContentBuilderInterface $contentBuilder,
    ) {
    }

    public function createConfigTransfer(
        ValidatorTransfer $validatorTransfer,
        ?ConfigContentTransfer $contentTransfer = null,
    ): ConfigTransfer {
        $contentTransfer ??= $this->contentBuilder->createDefaultContentTransfer();

        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = $validatorTransfer;
        $configTransfer->content = $contentTransfer;

        return $configTransfer;
    }

    public function createErrorConfigTransfer(string $errorMessage): ConfigTransfer
    {
        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = $this->createErrorValidatorTransfer($errorMessage);
        $configTransfer->content = $this->contentBuilder->createDefaultContentTransfer();

        return $configTransfer;
    }
}
