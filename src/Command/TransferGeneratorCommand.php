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
    description: 'Generate Transfer Objects from definition templates.',
    aliases: ['p:t:g'],
    hidden: false,
)]
class TransferGeneratorCommand extends Command
{
    use InputNormalizerTrait;

    private const string HELP = <<<'HELP'
This command generates Transfer Objects based on YML definitions.
The command requires a path to the configuration file in YML format.

The configuration specifies:
  - The directory containing the definition files.
  - The namespace for the Transfer Objects.
  - The output directory where the generated Transfer Objects will be saved.
HELP;

    private const string OPTION_NAME_CONFIGURATION = 'configuration';
    private const string OPTION_SHORTCUT_CONFIGURATION = 'c';
    private const string OPTION_DESCRIPTION_CONFIGURATION = 'Path to the YML configuration file.';

    private const string START_SECTION_NAME = 'Generating Transfer Objects ✨';

    private const string ERROR_MISSED_OPTION_CONFIG_MESSAGE = <<<'MESSAGE'
The required -c option is missing. Please provide the path to the YML configuration file.
MESSAGE;

    private const string CONFIG_MESSAGE_TEMPLATE = 'Config: <info>%s</info>.';
    private const string TRANSFER_OBJECT_MESSAGE_TEMPLATE = 'Transfer Object: <info>%s</info>.';
    private const string DEFINITION_MESSAGE_TEMPLATE = 'Definition File: <comment>%s</comment>.';

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

        $styleOutput->writeln(sprintf(self::CONFIG_MESSAGE_TEMPLATE, $configPath));
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

        $generatorTransfer = $generatorFiber->start($configPath);

        $this->writelnErrorMessages($generatorTransfer, $styleOutput);
        $this->writelnDebugMessages($generatorTransfer, $styleOutput);

        while (!$generatorFiber->isTerminated()) {
            $generatorTransfer = $generatorFiber->resume();

            $this->writelnErrorMessages($generatorTransfer, $styleOutput);
            $this->writelnDebugMessages($generatorTransfer, $styleOutput);
        }

        return $generatorFiber->getReturn();
    }

    private function writelnDebugMessages(
        ?TransferGeneratorTransfer $generatorTransfer,
        SymfonyStyle $styleOutput,
    ): void {
        if (
            !$styleOutput->isVerbose()
            || $generatorTransfer === null
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
        ?TransferGeneratorTransfer $generatorTransfer,
        SymfonyStyle $styleOutput,
    ): void {
        if ($generatorTransfer === null || $generatorTransfer->validator->isValid === true) {
            return;
        }

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
        $configPath = is_string($configPath) ? $this->normalizePath($configPath) : '';

        if ($configPath === '') {
            $styleOutput->error(self::ERROR_MISSED_OPTION_CONFIG_MESSAGE);
        }

        return $configPath;
    }
}
