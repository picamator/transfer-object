<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use ArrayObject;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Symfony\Component\Console\Style\SymfonyStyle;

trait ValidatorMessageTrait
{
    /**
     * @param ArrayObject<int, ValidatorMessageTransfer> $errorMessages
     */
    protected function writelnValidatorErrorMessages(ArrayObject $errorMessages, SymfonyStyle $styleOutput): void
    {
        foreach ($errorMessages as $errorMessage) {
            $styleOutput->warning($errorMessage->errorMessage);
        }
    }
}
