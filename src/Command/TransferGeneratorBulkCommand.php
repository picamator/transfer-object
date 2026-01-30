<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Command\Helper\InputNormalizerTrait;
use Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'picamator:transfer:generate:bulk|p:t:g:b',
    description: 'Generates Transfer Objects based on multiple configurations and their definition files.',
    // phpcs:disable Generic.Files.LineLength
    help: <<<'HELP'
The <info>%command.name%</info> command generates Transfer Objects from definition files specified by multiple configuration files listed in a TXT file.

<options=bold>The configuration list specifies:</>
  — Each line contains the path to a configuration file in YML format.

<options=bold>Documentation:</>
For more details, please visit "<href=https://github.com/picamator/transfer-object/wiki/Console-Commands#transfer-generate-bulk>project's Wiki</>".

HELP
)]
readonly class TransferGeneratorBulkCommand
{
    use InputNormalizerTrait;

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
        private TransferGeneratorFacadeInterface $generatorFacade = new TransferGeneratorFacade(),
    ) {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Option(
            description: self::OPTION_DESCRIPTION_CONFIGURATION,
            name: self::OPTION_NAME_BULK,
            shortcut: self::OPTION_SHORTCUT_BULK,
        )] string $configListPath = '',
    ): int {
        $io->section(self::START_SECTION_NAME);

        $configListPath = $this->normalizePath($configListPath);
        if ($configListPath === '') {
            $io->error(self::ERROR_MISSED_OPTION_BULK_MESSAGE);

            return Command::FAILURE;
        }

        $io->writeln(sprintf(self::CONFIGURATION_LIST_MESSAGE_TEMPLATE, $configListPath));
        $io->newLine();

        try {
            $result = $this->generateTransfers($io, $configListPath);
        } catch (Throwable $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        if ($result) {
            $io->success(self::SUCCESS_MESSAGE);

            return Command::SUCCESS;
        }

        return Command::FAILURE;
    }

    /**
     * @throws Throwable
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     */
    private function generateTransfers(SymfonyStyle $io, string $configListPath): bool
    {
        $generatorFiber = $this->generatorFacade->getTransferGeneratorBulkFiber();

        /** @var \Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer $bulkTransfer */
        $bulkTransfer = $generatorFiber->start($configListPath);

        $progressBar = $this->getProgressBar($io, $bulkTransfer);
        $this->writelnErrorMessages($io, $bulkTransfer);

        while (!$generatorFiber->isTerminated()) {
            $bulkTransfer = $generatorFiber->resume();
            if ($bulkTransfer === null) {
                continue;
            }

            $this->advanceProgressBar($bulkTransfer, $progressBar);
            $this->writelnErrorMessages($io, $bulkTransfer);
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
        SymfonyStyle $io,
        TransferGeneratorBulkTransfer $bulkTransfer,
    ): ?ProgressBar {
        $max = $bulkTransfer->progress->totalBytes;
        if ($max === 0) {
            return null;
        }

        ProgressBar::setFormatDefinition('minimal', 'Progress: %percent%%');

        $progressBar = new ProgressBar($io, max: $max);
        $progressBar->setFormat('minimal');

        return $progressBar;
    }

    private function writelnErrorMessages(SymfonyStyle $io, TransferGeneratorBulkTransfer $bulkTransfer): void
    {
        if ($bulkTransfer->validator->isValid === true) {
            return;
        }

        $io->newLine();

        $configFile = $bulkTransfer->progress->content;
        if ($configFile !== '') {
            $io->writeln(sprintf(self::CONFIGURATION_MESSAGE_TEMPLATE, $configFile));
        }

        foreach ($bulkTransfer->validator->errorMessages as $errorMessage) {
            $io->error($errorMessage->errorMessage);
        }
    }
}
