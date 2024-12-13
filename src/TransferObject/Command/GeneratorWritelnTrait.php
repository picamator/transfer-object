<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Generated\GeneratorTransfer;
use Symfony\Component\Console\Output\OutputInterface;

trait GeneratorWritelnTrait
{
    protected const string FAILED_TEMPLATE = 'Failed generating %s.';
    protected const string FAILED_MESSAGE = 'Failed generate Transfer Objects.';
    protected const string SUCCESS_MESSAGE = 'Transfer Objects successfully generated.';

    protected function writelnSuccess(OutputInterface $output, string $message): void
    {
        $output->writeln(sprintf('<info>%s</info>', $message));
    }

    protected function writelnGeneratorTransfer(GeneratorTransfer $generatorTransfer, OutputInterface $output): void
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

