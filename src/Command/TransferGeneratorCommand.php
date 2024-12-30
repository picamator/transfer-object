<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use ArrayObject;
use Picamator\TransferObject\Command\Helper\ProgressBar;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class TransferGeneratorCommand extends Command
{
    private const string NAME = 'generate:transfer';
    private const string DESCRIPTION = 'Generates Transfer Objects based on definitions template.';
    private const string HELP = 'Configuration path should be specified.';

    private const string OPTION_NAME_CONFIGURATION = 'configuration';
    private const string OPTION_SHORTCUT_CONFIGURATION = 'c';
    private const string OPTION_DESCRIPTION_CONFIGURATION = 'Path to YML configuration.';

    private const string ERROR_TEMPLATE = 'Failed generating Transfer Object "%s" based on definition file "%s".';
    private const string ERROR_MISSED_OPTION_CONFIG_MESSAGE =
        'Command option -c is not set. Please provide the path to the YML configuration.';
    private const string ERROR_MESSAGE = 'Failed to generate Transfer Objects.';
    private const string SUCCESS_MESSAGE = 'Transfer Objects successfully generated.';

    private const string START_SECTION_NAME = 'Transfer Object Generation';

    public function __construct(
        ?string $name = null,
        private readonly TransferGeneratorFacadeInterface $generatorFacade = new TransferGeneratorFacade(),
    ) {
        parent::__construct($name);
    }

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
        $configPath = $input->getOption(self::OPTION_NAME_CONFIGURATION) ?: '';

        $styleOutput = new SymfonyStyle($input, $output);
        $styleOutput->section(self::START_SECTION_NAME);

        $isSuccess = $this->loadConfig($configPath, $styleOutput);
        if (!$isSuccess) {
            return Command::FAILURE;
        }

        $isSuccess = $this->generateTransfers($styleOutput);
        if ($isSuccess) {
            $styleOutput->success(self::SUCCESS_MESSAGE);

            return Command::SUCCESS;
        }

        $styleOutput->error(self::ERROR_MESSAGE);

        return Command::FAILURE;
    }

    private function generateTransfers(SymfonyStyle $styleOutput): bool
    {
        $generatorFiber = $this->generatorFacade->getTransferGeneratorFiber();
        $progressBar = new ProgressBar($styleOutput);

        $generatorTransfer = $generatorFiber->start($progressBar);
        $this->writelnGeneratorTransfer($generatorTransfer, $styleOutput);

        while (!$generatorFiber->isTerminated()) {
            $generatorTransfer = $generatorFiber->resume();
            $this->writelnGeneratorTransfer($generatorTransfer, $styleOutput);
        }

        return $generatorFiber->getReturn();
    }

    private function writelnGeneratorTransfer(
        ?TransferGeneratorTransfer $generatorTransfer,
        SymfonyStyle $styleOutput,
    ): void {
        if ($generatorTransfer === null || $generatorTransfer->validator?->isValid === true) {
            return;
        }

        $error = sprintf(
            self::ERROR_TEMPLATE,
            $generatorTransfer->className ?: '---',
            $generatorTransfer->fileName ?: '---',
        );
        $styleOutput->error($error);

        $this->writelnValidatorErrorMessages($generatorTransfer->validator->errorMessages, $styleOutput);
    }

    private function loadConfig(string $configPath, SymfonyStyle $styleOutput): bool
    {
        if ($configPath === '') {
            $styleOutput->error(self::ERROR_MESSAGE);
            $styleOutput->error(self::ERROR_MISSED_OPTION_CONFIG_MESSAGE);

            return false;
        }

        $configTransfer = $this->generatorFacade->loadConfig($configPath);
        if (!$configTransfer->validator->isValid) {
            $this->writelnValidatorErrorMessages($configTransfer->validator->errorMessages, $styleOutput);

            return false;
        }

        $styleOutput->info('Config: ' . $configPath);

        return true;
    }

    /**
     * @param \ArrayObject<int, ValidatorMessageTransfer> $errorMessages
     */
    private function writelnValidatorErrorMessages(ArrayObject $errorMessages, SymfonyStyle $styleOutput): void
    {
        foreach ($errorMessages as $errorMessage) {
            $styleOutput->warning($errorMessage->errorMessage);
        }
    }
}
