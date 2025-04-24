<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command\Helper;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

trait InputOptionTrait
{
    protected const string ERROR_MISSED_OPTION_MESSAGE_TEMPLATE
        = 'Missed required command option "%s". Please set the option and try again.';

    protected function getInputOption(string $optionName, InputInterface $input, SymfonyStyle $styleOutput): ?string
    {
        $optionValue = $input->getOption($optionName) ?: '';
        if ($optionValue !== '' && is_string($optionValue)) {
            return $optionValue;
        }

        $styleOutput->error(sprintf(self::ERROR_MISSED_OPTION_MESSAGE_TEMPLATE, $optionName));

        return null;
    }
}
