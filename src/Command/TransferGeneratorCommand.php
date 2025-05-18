<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Command\Helper\InputNormalizerTrait;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'picamator:transfer:generate',
    description: 'Generates Transfer Objects from definition files specified by configuration.',
    aliases: ['p:t:g'],
    hidden: false
)]
class TransferGeneratorCommand extends Command
{
    use InputNormalizerTrait;

    /**
     * phpcs:disable Generic.Files.LineLength
     */
    private const string HELP = <<<'HELP'
This command generates Transfer Objects based on configuration file in YML format.

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

HELP;

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
        ?string $name = null,
        private readonly TransferGeneratorFacadeInterface $generatorFacade = new TransferGeneratorFacade(),
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setHelp(help: self::HELP);

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

        $configPath = $this->getConfigPath($input, $styleOutput);
        if ($configPath === '') {
            return Command::FAILURE;
        }

        $styleOutput->writeln(sprintf(self::CONFIGURATION_MESSAGE_TEMPLATE, $configPath));
        $styleOutput->newLine();

        if (!$this->generateTransfers($configPath, $styleOutput)) {
            return Command::FAILURE;
        }

        $styleOutput->success(self::SUCCESS_MESSAGE);

        return Command::SUCCESS;
    }

    private function generateTransfers(string $configPath, SymfonyStyle $styleOutput): bool
    {
        $generatorFiber = $this->generatorFacade->getTransferGeneratorFiber();

        /** @var \Picamator\TransferObject\Generated\TransferGeneratorTransfer $generatorTransfer */
        $generatorTransfer = $generatorFiber->start($configPath);

        $this->writelnErrorMessages($generatorTransfer, $styleOutput);

        while (!$generatorFiber->isTerminated()) {
            $generatorTransfer = $generatorFiber->resume();
            if ($generatorTransfer === null) {
                continue;
            }

            $this->writelnErrorMessages($generatorTransfer, $styleOutput);
            $this->writelnDebugMessages($generatorTransfer, $styleOutput);
        }

        return $generatorFiber->getReturn();
    }

    private function writelnDebugMessages(
        TransferGeneratorTransfer $generatorTransfer,
        SymfonyStyle $styleOutput,
    ): void {
        if (
            !$styleOutput->isVerbose()
            || $generatorTransfer->validator->isValid === false
            || $generatorTransfer->fileName === null
            || $generatorTransfer->className === null
        ) {
            return;
        }

        static $fileName = $generatorTransfer->fileName;

        if ($fileName !== $generatorTransfer->fileName) {
            $fileName = $generatorTransfer->fileName;

            $styleOutput->newLine();
        }

        $styleOutput->writeln(
            sprintf(
                self::DEBUG_MESSAGE_TEMPLATE,
                $generatorTransfer->fileName,
                $generatorTransfer->className,
            )
        );
    }

    private function writelnErrorMessages(
        TransferGeneratorTransfer $generatorTransfer,
        SymfonyStyle $styleOutput,
    ): void {
        if ($generatorTransfer->validator->isValid === true) {
            return;
        }

        $styleOutput->newLine();

        $className = $generatorTransfer->className ?? '';
        if ($className !== '') {
            $styleOutput->writeln(sprintf(self::TRANSFER_OBJECT_MESSAGE_TEMPLATE, $className));
        }

        $fileName = $generatorTransfer->fileName ?? '';
        if ($fileName !== '') {
            $styleOutput->writeln(sprintf(self::DEFINITION_MESSAGE_TEMPLATE, $fileName));
        }

        foreach ($generatorTransfer->validator->errorMessages as $errorMessage) {
            $styleOutput->error($errorMessage->errorMessage);
        }
    }

    private function getConfigPath(InputInterface $input, SymfonyStyle $styleOutput): string
    {
        $configPath = $input->getOption(name: self::OPTION_NAME_CONFIGURATION);
        $configPath = $this->normalizePath($configPath);

        if ($configPath === '') {
            $styleOutput->error(self::ERROR_MISSED_OPTION_CONFIGURATION_MESSAGE);
        }

        return $configPath;
    }
}
