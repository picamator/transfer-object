<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Config\ConfigFacade;
use Picamator\TransferObject\Generated\GeneratorTransfer;
use Picamator\TransferObject\Generator\GeneratorFacade;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class GeneratorCommand extends Command
{
    private const string NAME = 'generate:transfer';
    private const string DESCRIPTION = 'Generates Transfer Objects based on definitions template.';
    private const string HELP = 'Configuration path should be specified.';

    private const string OPTION_NAME_CONFIGURATION = 'configuration';
    private const string OPTION_SHORTCUT_CONFIGURATION = 'c';
    private const string OPTION_DESCRIPTION_CONFIGURATION = 'Path to YML configuration.';
    private const string OPTION_DEFAULT_CONFIGURATION = '/home/transfer/transfer-object/config/generator.yml';

    private const string FAILED_TEMPLATE = 'Failed generating %s.';
    private const string FAILED_MESSAGE = 'Failed generate Transfer Objects.';
    private const string SUCCESS_MESSAGE = 'Transfer Objects successfully generated.';

    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->setHelp(self::HELP)
            ->addOption(
                name: self::OPTION_NAME_CONFIGURATION,
                shortcut: self::OPTION_SHORTCUT_CONFIGURATION,
                mode: InputOption::VALUE_REQUIRED,
                description: self::OPTION_DESCRIPTION_CONFIGURATION,
                default: self::OPTION_DEFAULT_CONFIGURATION,
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputOutput = new SymfonyStyle($input, $output);

        $configPath = $input->getOption(self::OPTION_NAME_CONFIGURATION);
        $validatorTransfer = new ConfigFacade()->loadConfig($configPath);
        if (!$validatorTransfer->isValid) {
            $inputOutput->error(self::FAILED_MESSAGE);
            $inputOutput->error($validatorTransfer->errorMessage);

            return Command::FAILURE;
        }

        $errorItemCallback = fn(GeneratorTransfer $generatorTransfer) => $this->handleErrors($inputOutput, $generatorTransfer);
        $isSuccess = new GeneratorFacade()->generateTransfers($errorItemCallback);

        if ($isSuccess) {
            $inputOutput->success(self::SUCCESS_MESSAGE);

            return Command::SUCCESS;
        }

        $inputOutput->error(self::FAILED_MESSAGE);

        return Command::FAILURE;
    }

    private function handleErrors(SymfonyStyle $inputOutput, GeneratorTransfer $generatorTransfer): void
    {
        $inputOutput->error(sprintf(self::FAILED_TEMPLATE, $generatorTransfer->definitionKey));

        $errorMessages = $generatorTransfer->validator?->errorMessages?->getArrayCopy();
        $inputOutput->warning($errorMessages);
    }
}

