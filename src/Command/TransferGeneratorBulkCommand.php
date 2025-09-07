<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Command\Helper\InputNormalizerTrait;
use Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'picamator:transfer:generate:bulk',
    description: 'Generates Transfer Objects based on multiple configurations and their definition files.',
    aliases: ['p:t:g:b'],
    hidden: false
)]
class TransferGeneratorBulkCommand extends Command
{
    use InputNormalizerTrait;

    /**
     * phpcs:disable Generic.Files.LineLength
     */
    private const string HELP = <<<'HELP'
This command generates Transfer Objects from definition files specified by multiple configuration files listed in a TXT file..

<options=bold>The configuration list specifies:</>
  -  Each line contains the path to a configuration file in YML format.

<options=bold>Documentation:</>
For more details, please visit "<href=https://github.com/picamator/transfer-object/wiki/Console-Commands#transfer-generate-bulk>project's Wiki</>".

HELP;

    private const string OPTION_NAME_BULK = 'bulk';
    private const string OPTION_SHORTCUT_BULK = 'b';
    private const string OPTION_DESCRIPTION_CONFIGURATION = 'Path to the TXT configuration list file.';

    private const string START_SECTION_NAME = 'Generating Bulk Transfer Objects ✨';

    private const string ERROR_MISSED_OPTION_BULK_MESSAGE = <<<'MESSAGE'
The required -b option is missing. Please provide the path to the TXT configuration list file.
MESSAGE;

    private const string CONFIGURATION_LIST_MESSAGE_TEMPLATE = 'Configuration List: <comment>%s</comment>';
    private const string CONFIGURATION_MESSAGE_TEMPLATE = 'Configuration: <comment>%s</comment>';

    private const string SUCCESS_MESSAGE = 'All Transfer Objects were generated successfully! 🎉';

    public function __construct(
        ?string $name = null,
        private readonly TransferGeneratorFacadeInterface $generatorFacade = new TransferGeneratorFacade(),
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setHelp(help: self::HELP);

        $this->addOption(
            name: self::OPTION_NAME_BULK,
            shortcut: self::OPTION_SHORTCUT_BULK,
            mode: InputOption::VALUE_REQUIRED,
            description: self::OPTION_DESCRIPTION_CONFIGURATION,
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $styleOutput = new SymfonyStyle($input, $output);
        $styleOutput->section(self::START_SECTION_NAME);

        $configListPath = $this->getConfigListPath($input, $styleOutput);
        if ($configListPath === '') {
            return Command::FAILURE;
        }

        $styleOutput->writeln(sprintf(self::CONFIGURATION_LIST_MESSAGE_TEMPLATE, $configListPath));
        $styleOutput->newLine();

        if (!$this->generateTransfers($configListPath, $styleOutput)) {
            return Command::FAILURE;
        }

        $styleOutput->success(self::SUCCESS_MESSAGE);

        return Command::SUCCESS;
    }

    private function generateTransfers(string $configListPath, SymfonyStyle $styleOutput): bool
    {
        $generatorFiber = $this->generatorFacade->getTransferGeneratorBulkFiber();

        /** @var \Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer $bulkTransfer */
        $bulkTransfer = $generatorFiber->start($configListPath);

        $progressBar = $this->getProgressBar($bulkTransfer, $styleOutput);
        $this->writelnErrorMessages($bulkTransfer, $styleOutput);

        while (!$generatorFiber->isTerminated()) {
            $bulkTransfer = $generatorFiber->resume();
            if ($bulkTransfer === null) {
                continue;
            }

            $this->advanceProgressBar($bulkTransfer, $progressBar);
            $this->writelnErrorMessages($bulkTransfer, $styleOutput);
        }

        $progressBar?->finish();

        return $generatorFiber->getReturn();
    }

    private function advanceProgressBar(
        TransferGeneratorBulkTransfer $bulkTransfer,
        ?ProgressBar $progressBar,
    ): void {
        $step = $bulkTransfer->progress->progressBytes;
        $progressBar?->advance($step);
    }

    private function getProgressBar(
        TransferGeneratorBulkTransfer $bulkTransfer,
        SymfonyStyle $styleOutput,
    ): ?ProgressBar {
        $max = $bulkTransfer->progress->totalBytes;
        if ($max === 0) {
            return null;
        }

        ProgressBar::setFormatDefinition('minimal', 'Progress: %percent%%');

        $progressBar = new ProgressBar($styleOutput, max: $max);
        $progressBar->setFormat('minimal');

        return $progressBar;
    }

    private function writelnErrorMessages(
        TransferGeneratorBulkTransfer $bulkTransfer,
        SymfonyStyle $styleOutput,
    ): void {
        if ($bulkTransfer->validator->isValid === true) {
            return;
        }

        $styleOutput->newLine();

        $configFile = $bulkTransfer->progress->content;
        if ($configFile !== '') {
            $styleOutput->writeln(sprintf(self::CONFIGURATION_MESSAGE_TEMPLATE, $configFile));
        }

        foreach ($bulkTransfer->validator->errorMessages as $errorMessage) {
            $styleOutput->error($errorMessage->errorMessage);
        }
    }

    private function getConfigListPath(InputInterface $input, SymfonyStyle $styleOutput): string
    {
        $configListPath = $input->getOption(name: self::OPTION_NAME_BULK);
        $configListPath = $this->normalizePath($configListPath);

        if ($configListPath === '') {
            $styleOutput->error(self::ERROR_MISSED_OPTION_BULK_MESSAGE);
        }

        return $configListPath;
    }
}
