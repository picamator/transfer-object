<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Command;

use ArrayObject;
use Picamator\TransferObject\Config\ConfigFacade;
use Picamator\TransferObject\Generator\GeneratorFacade;
use Picamator\TransferObject\Transfer\Generated\GeneratorTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;
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

    private const string ERROR_TEMPLATE = 'Failed generating %s.';
    private const string ERROR_MISSED_OPTION_CONFIG_MESSAGE = 'Command\'s option -c is not set. Please provide path to YML configuration.';
    private const string ERROR_MESSAGE = 'Failed generate Transfer Objects.';
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
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputOutput = new SymfonyStyle($input, $output);

        $isSuccess = $this->loadConfig($input, $inputOutput);
        if (!$isSuccess) {
            return Command::FAILURE;
        }

        $isSuccess = $this->generateTransfers($inputOutput);

        if ($isSuccess) {
            $inputOutput->success(self::SUCCESS_MESSAGE);

            return Command::SUCCESS;
        }

        $inputOutput->error(self::ERROR_MESSAGE);

        return Command::FAILURE;
    }

    private function generateTransfers(SymfonyStyle $inputOutput): bool
    {
        $handleCallback = fn(?GeneratorTransfer $generatorTransfer) => $this->handleCallback($inputOutput, $generatorTransfer);

        return new GeneratorFacade()->generateTransfers($handleCallback);
    }

    private function handleCallback(SymfonyStyle $inputOutput, ?GeneratorTransfer $generatorTransfer): void
    {
        if ($generatorTransfer?->validator?->isValid !== false) {
            return;
        }

        $inputOutput->error(sprintf(self::ERROR_TEMPLATE, $generatorTransfer->definitionKey));

        $errorMessages = $generatorTransfer->validator->errorMessages;
        $errorMessages = array_map(fn(ValidatorMessageTransfer $messageTransfer) => $messageTransfer->errorMessage, $errorMessages->getArrayCopy());

        $inputOutput->warning($errorMessages);
    }

    private function loadConfig(InputInterface $input, SymfonyStyle $inputOutput): bool
    {
        $configPath = $input->getOption(self::OPTION_NAME_CONFIGURATION) ?: '';
        if ($configPath === '') {
            $inputOutput->error(self::ERROR_MESSAGE);
            $inputOutput->error(self::ERROR_MISSED_OPTION_CONFIG_MESSAGE);

            return false;
        }

        $validatorTransfer = new ConfigFacade()->loadConfig($configPath);
        if (!$validatorTransfer->isValid) {
            $inputOutput->error(self::ERROR_MESSAGE);
            $inputOutput->error($validatorTransfer->errorMessage);

            return false;
        }

        return true;
    }
}

