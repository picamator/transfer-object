<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Validator;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;

interface ConfigValidatorInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function validateFile(string $filePath): ValidatorTransfer;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function validateContent(ConfigContentTransfer $configContentTransfer): ValidatorTransfer;
}
