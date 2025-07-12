<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;

readonly class ConfigValidator implements ConfigValidatorInterface
{
    public function __construct(
        private ConfigFileValidatorInterface $configFileValidator,
        private BulkContentValidatorInterface $bulkContentValidator,
    ) {
    }

    public function validateFile(string $filePath): ValidatorTransfer
    {
        return $this->configFileValidator->validateFile($filePath);
    }

    public function validateContent(ConfigContentTransfer $configContentTransfer): ValidatorTransfer
    {
        return $this->bulkContentValidator->validateContent($configContentTransfer);
    }
}
