<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Generated\GeneratorTransfer;
use Symfony\Component\Console\Output\OutputInterface;

trait WritelnTrait
{
    private const string SUCCESS_TEMPLATE = 'Successfully generated %s';
    private const string FAILED_TEMPLATE = 'Failed generating %s';

    protected function writelnGeneratorTransfer(GeneratorTransfer $generatorTransfer, OutputInterface $output): void
    {
        if ($generatorTransfer->validator->isValid === false) {
            $this->writelnGeneratorErrors($generatorTransfer, $output);

            return;
        }

        $output->writeln($this->formatSuccess(sprintf(static::SUCCESS_TEMPLATE, $generatorTransfer->definitionKey)));
    }

    protected function writelnGeneratorErrors(GeneratorTransfer $generatorTransfer, OutputInterface $output): void
    {
        $output->writeln($this->formatError(
            sprintf(static::FAILED_TEMPLATE, $generatorTransfer->definitionKey)
        ));

        foreach ($generatorTransfer->validator->errorMessages as $messageTransfer) {
            $output->writeln($this->formatError($messageTransfer->message));
            if ($messageTransfer->context) {
                $output->writeln(print_r($messageTransfer->context, true));
            }
        }
    }

    private function formatSuccess(string $message): string
    {
        return sprintf('<info>%s</info>', $message);
    }

    private function formatError(string $message): string
    {
        return sprintf('<error>%s</error>', $message);
    }
}

