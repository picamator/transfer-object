<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use ArrayObject;
use Picamator\TransferObject\Command\Exception\CommandException;
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

    private const string START_SECTION_NAME = 'Transfer Object Generation';

    private const string ERROR_MISSED_OPTION_CONFIG_MESSAGE =
        'Command option -c is not set. Please provide the path to the YML configuration.';

    private const string TRANSFER_OBJECT_MESSAGE_TEMPLATE = 'Transfer Object: "%s".';
    private const string DEFINITION_MESSAGE_TEMPLATE = 'Definition file: "%s".';
    private const string ERROR_MESSAGE = 'Failed to generate Transfer Objects.';

    private const string SUCCESS_MESSAGE = 'Transfer Objects were generated successfully.';

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
        $styleOutput = new SymfonyStyle($input, $output);
        $styleOutput->section(self::START_SECTION_NAME);

        $configPath = $input->getOption(self::OPTION_NAME_CONFIGURATION) ?: '';
        if ($configPath === '') {
            $styleOutput->error(self::ERROR_MESSAGE);
            $styleOutput->error(self::ERROR_MISSED_OPTION_CONFIG_MESSAGE);

            return Command::FAILURE;
        }

        $isSuccess = $this->generateTransfers($configPath, $styleOutput);
        if ($isSuccess) {
            $styleOutput->success(self::SUCCESS_MESSAGE);

            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }

    private function generateTransfers(string $configPath, SymfonyStyle $styleOutput): bool
    {
        $generatorFiber = $this->generatorFacade->getTransferGeneratorFiber();

        $generatorTransfer = $generatorFiber->start($configPath);
        if ($generatorTransfer === null || $generatorTransfer->validator?->isValid === false) {
            $this->writelnGeneratorError($generatorTransfer, $styleOutput);
            $generatorFiber->throw(new CommandException());

            return $generatorFiber->getReturn();
        }

        while (!$generatorFiber->isTerminated()) {
            $generatorTransfer = $generatorFiber->resume();
            if ($generatorTransfer !== null && $generatorTransfer->validator?->isValid === false) {
                $this->writelnGeneratorError($generatorTransfer, $styleOutput);
                $generatorFiber->throw(new CommandException());
            }
        }

        return $generatorFiber->getReturn();
    }

    private function writelnGeneratorError(
        ?TransferGeneratorTransfer $generatorTransfer,
        SymfonyStyle $styleOutput,
    ): void {
        $styleOutput->error(self::ERROR_MESSAGE);

        if ($generatorTransfer->className !== null) {
            $styleOutput->error(sprintf(self::TRANSFER_OBJECT_MESSAGE_TEMPLATE, $generatorTransfer->className));
        }

        if ($generatorTransfer->fileName !== null) {
            $styleOutput->error(sprintf(self::DEFINITION_MESSAGE_TEMPLATE, $generatorTransfer->fileName));
        }

        foreach ($generatorTransfer->validator->errorMessages as $errorMessage) {
            $styleOutput->error($errorMessage->errorMessage);
        }
    }
}
