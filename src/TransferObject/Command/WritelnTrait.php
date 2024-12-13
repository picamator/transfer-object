<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Generated\GeneratorTransfer;
use Symfony\Component\Console\Output\OutputInterface;

trait WritelnTrait
{
    protected const string FAILED_TEMPLATE = 'Failed generating %s.';

    protected const string SUCCESS_MESSAGE = 'Transfer Objects successfully generated.';
    protected const string FAILED_MESSAGE = 'Failed generate Transfer Objects.';

    protected function writelnSuccess(OutputInterface $output): void
    {
        $output->writeln(sprintf('<info>%s</info>', static::SUCCESS_MESSAGE));
    }

    protected function writelnGeneratorTransfer(GeneratorTransfer $generatorTransfer, OutputInterface $output): void
    {
        if ($generatorTransfer->validator->isValid) {
            return;
        }

        $this->writelnGeneratorErrors($generatorTransfer, $output);
    }

    protected function writelnGeneratorErrors(GeneratorTransfer $generatorTransfer, OutputInterface $output): void
    {
        $this->writelnError($output, sprintf(static::FAILED_TEMPLATE, $generatorTransfer->definitionKey));

        foreach ($generatorTransfer->validator->errorMessages as $message) {
            $this->writelnError($output, $message);
        }
    }

    protected function writelnError(OutputInterface $output, string $message): void
    {
        $output->writeln(sprintf('<error>%s</error>', $message));
    }
}

