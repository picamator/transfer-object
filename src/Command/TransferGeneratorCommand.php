<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Command\Helper\InputOptionTrait;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TransferGeneratorCommand extends Command
{
    use InputOptionTrait;

    protected const string NAME = 'transfer:generate';
    protected const string DESCRIPTION = 'Generates Transfer Objects based on definitions template.';
    protected const string HELP = <<<'HELP'
Configuration option includes path to definition directory, transfer object namespace,
and the path to generated objects.
HELP;

    protected const string OPTION_NAME_CONFIGURATION = 'configuration';
    protected const string OPTION_SHORTCUT_CONFIGURATION = 'c';
    protected const string OPTION_DESCRIPTION_CONFIGURATION = 'Path to YML configuration.';

    protected const string START_SECTION_NAME = 'Transfer Object Generation';

    protected const string TRANSFER_OBJECT_MESSAGE_TEMPLATE = 'Transfer Object: "%s".';
    protected const string DEFINITION_MESSAGE_TEMPLATE = 'Definition file: "%s".';

    protected const string SUCCESS_MESSAGE = 'Transfer Objects were generated successfully.';

    public function __construct(
        ?string $name = null,
        protected readonly TransferGeneratorFacadeInterface $generatorFacade = new TransferGeneratorFacade(),
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->setHelp(self::HELP);

        $this->addOption(
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

        $configPath = $this->getInputOption(self::OPTION_NAME_CONFIGURATION, $input, $styleOutput);
        if ($configPath === null) {
            return Command::FAILURE;
        }

        if ($this->generateTransfers($configPath, $styleOutput)) {
            $styleOutput->success(self::SUCCESS_MESSAGE);

            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }

    protected function generateTransfers(string $configPath, SymfonyStyle $styleOutput): bool
    {
        $generatorFiber = $this->generatorFacade->getTransferGeneratorFiber();

        $generatorTransfer = $generatorFiber->start($configPath);
        $this->writelnGeneratorError($generatorTransfer, $styleOutput);

        while (!$generatorFiber->isTerminated()) {
            $generatorTransfer = $generatorFiber->resume();
            $this->writelnGeneratorError($generatorTransfer, $styleOutput);
        }

        return $generatorFiber->getReturn();
    }

    protected function writelnGeneratorError(
        ?TransferGeneratorTransfer $generatorTransfer,
        SymfonyStyle $styleOutput,
    ): void {
        if ($generatorTransfer === null || $generatorTransfer->validator->isValid === true) {
            return;
        }

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
