<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Command\Helper\InputNormalizerTrait;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'picamator:transfer:generate|p:t:g',
    description: 'Generates Transfer Objects from definition files specified by configuration.',
    // phpcs:disable Generic.Files.LineLength
    help: <<<'HELP'
The <info>%command.name%</info> command generates Transfer Objects based on the configuration file in YML format.

<options=bold>The configuration specifies:</>
  - The directory containing the definition files.
  - The namespace for the Transfer Objects.
  - The output directory where the generated Transfer Objects will be saved.

<options=bold>Schema:</>
  - The configuration file should follow "<href=https://raw.githubusercontent.com/picamator/transfer-object/main/schema/config.schema.json>config.schema.json</>".
  - The definition files should follow "<href=https://raw.githubusercontent.com/picamator/transfer-object/main/schema/definition.schema.json>definition.schema.json</>".

<options=bold>Verbosity:</>
The command supports the first verbosity level to display additional details about the generated Transfer Objects.

<options=bold>Documentation:</>
For more details, please visit "<href=https://github.com/picamator/transfer-object/wiki/Console-Commands#transfer-generate>project's Wiki</>".

HELP
)]
readonly class TransferGeneratorCommand
{
    use InputNormalizerTrait;

    private const string OPTION_NAME_CONFIGURATION = 'configuration';
    private const string OPTION_SHORTCUT_CONFIGURATION = 'c';
    private const string OPTION_DESCRIPTION_CONFIGURATION = 'Path to the YML configuration file.';

    private const string START_SECTION_NAME = 'Generating Transfer Objects ✨';

    private const string ERROR_MISSED_OPTION_CONFIGURATION_MESSAGE = <<<'MESSAGE'
The required -c option is missing. Please provide the path to the YML configuration file.
MESSAGE;

    private const string CONFIGURATION_MESSAGE_TEMPLATE = 'Configuration: <comment>%s</comment>';
    private const string TRANSFER_OBJECT_MESSAGE_TEMPLATE = 'Transfer Object: <comment>%s</comment>';
    private const string DEFINITION_MESSAGE_TEMPLATE = 'Definition File: <comment>%s</comment>';

    private const string DEBUG_MESSAGE_TEMPLATE = '<comment>%s</comment>: <info>%s</info>';

    private const string SUCCESS_MESSAGE = 'All Transfer Objects were generated successfully! 🎉';

    public function __construct(
        private TransferGeneratorFacadeInterface $generatorFacade = new TransferGeneratorFacade(),
    ) {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Option(
            description: self::OPTION_DESCRIPTION_CONFIGURATION,
            name: self::OPTION_NAME_CONFIGURATION,
            shortcut: self::OPTION_SHORTCUT_CONFIGURATION,
        )] string $configPath = '',
    ): int {
        $io->section(self::START_SECTION_NAME);

        $configPath = $this->normalizePath($configPath);
        if ($configPath === '') {
            $io->error(self::ERROR_MISSED_OPTION_CONFIGURATION_MESSAGE);

            return Command::FAILURE;
        }

        $io->writeln(sprintf(self::CONFIGURATION_MESSAGE_TEMPLATE, $configPath));
        $io->newLine();

        try {
            $result = $this->generateTransfers($io, $configPath);
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
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     * @throws \Throwable
     */
    private function generateTransfers(SymfonyStyle $io, string $configPath): bool
    {
        $generatorFiber = $this->generatorFacade->getTransferGeneratorFiber();

        /** @var \Picamator\TransferObject\Generated\TransferGeneratorTransfer $generatorTransfer */
        $generatorTransfer = $generatorFiber->start($configPath);

        $this->writelnErrorMessages($io, $generatorTransfer);

        while (!$generatorFiber->isTerminated()) {
            $generatorTransfer = $generatorFiber->resume();
            if ($generatorTransfer === null) {
                continue;
            }

            $this->writelnErrorMessages($io, $generatorTransfer);
            if ($this->isDebugMessages($io, $generatorTransfer)) {
                $lastFileName ??= $generatorTransfer->fileName;
                $this->writelnDebugMessages($io, $generatorTransfer, $lastFileName);
            }
        }

        return $generatorFiber->getReturn();
    }

    private function writelnDebugMessages(
        SymfonyStyle $io,
        TransferGeneratorTransfer $generatorTransfer,
        ?string &$lastFileName,
    ): void {
        if ($lastFileName !== $generatorTransfer->fileName) {
            $lastFileName = $generatorTransfer->fileName;

            $io->newLine();
        }

        $io->writeln(
            sprintf(
                self::DEBUG_MESSAGE_TEMPLATE,
                $generatorTransfer->fileName,
                $generatorTransfer->className,
            )
        );
    }

    private function isDebugMessages(SymfonyStyle $io, TransferGeneratorTransfer $generatorTransfer): bool
    {
        return $io->isVerbose()
            && $generatorTransfer->validator->isValid === true
            && $generatorTransfer->fileName !== null
            && $generatorTransfer->className !== null;
    }

    private function writelnErrorMessages(SymfonyStyle $io, TransferGeneratorTransfer $generatorTransfer): void
    {
        if ($generatorTransfer->validator->isValid === true) {
            return;
        }

        $io->newLine();

        $className = $generatorTransfer->className ?? '';
        if ($className !== '') {
            $io->writeln(sprintf(self::TRANSFER_OBJECT_MESSAGE_TEMPLATE, $className));
        }

        $fileName = $generatorTransfer->fileName ?? '';
        if ($fileName !== '') {
            $io->writeln(sprintf(self::DEFINITION_MESSAGE_TEMPLATE, $fileName));
        }

        foreach ($generatorTransfer->validator->errorMessages as $errorMessage) {
            $io->error($errorMessage->errorMessage);
        }
    }
}
