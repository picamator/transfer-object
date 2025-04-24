<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Command\Helper\InputOptionTrait;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacadeInterface;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

class DefinitionGeneratorCommand extends Command
{
    use InputOptionTrait;

    protected const string NAME = 'definition:generate';
    protected const string DESCRIPTION = 'Generates Transfer Object definition files.';
    protected const string HELP = <<<'HELP'
Based on JSON file, generates Transfer Object definition files.
HELP;

    protected const string OPTION_NAME_DEFINITION = 'definition';
    protected const string OPTION_SHORTCUT_DEFINITION = 'd';
    protected const string OPTION_DESCRIPTION_DEFINITION = 'Path where to save generated definition files.';

    protected const string OPTION_NAME_CLASS = 'class';
    protected const string OPTION_SHORTCUT_CLASS = 'c';
    protected const string OPTION_DESCRIPTION_CLASS = 'Transfer Object class name.';

    protected const string OPTION_NAME_JSON = 'json';
    protected const string OPTION_SHORTCUT_JSON = 'j';
    protected const string OPTION_DESCRIPTION_JSON = 'Path to the JSON file.';

    protected const string START_SECTION_NAME = 'Definition Generation';

    protected const string ERROR_MESSAGE_JSON_TEMPLATE = 'Fail to parse "%s" JSON file. Error: "%s".';

    protected const string SUCCESS_MESSAGE_TEMPLATE = 'Definition files %d were generated successfully.';

    public function __construct(
        ?string $name = null,
        protected readonly DefinitionGeneratorFacadeInterface $generatorFacade = new DefinitionGeneratorFacade(),
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->setHelp(self::HELP);

        $this->addOption(
            name: self::OPTION_NAME_DEFINITION,
            shortcut: self::OPTION_SHORTCUT_DEFINITION,
            mode: InputOption::VALUE_REQUIRED,
            description: self::OPTION_DESCRIPTION_DEFINITION,
        );

        $this->addOption(
            name: self::OPTION_NAME_CLASS,
            shortcut: self::OPTION_SHORTCUT_CLASS,
            mode: InputOption::VALUE_REQUIRED,
            description: self::OPTION_DESCRIPTION_CLASS,
        );

        $this->addOption(
            name: self::OPTION_NAME_JSON,
            shortcut: self::OPTION_SHORTCUT_JSON,
            mode: InputOption::VALUE_REQUIRED,
            description: self::OPTION_DESCRIPTION_JSON,
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $styleOutput = new SymfonyStyle($input, $output);
        $styleOutput->section(self::START_SECTION_NAME);

        $generatorTransfer = $this->createGeneratorTransfer($input, $styleOutput);
        if ($generatorTransfer === null) {
            return Command::FAILURE;
        }

        return $this->generateDefinitions($generatorTransfer, $styleOutput) ?  Command::SUCCESS : Command::FAILURE;
    }

    protected function generateDefinitions(
        DefinitionGeneratorTransfer $generatorTransfer,
        SymfonyStyle $styleOutput,
    ): bool {
        try {
            $generatedCount = $this->generatorFacade->generateDefinitionsOrFail($generatorTransfer);
        } catch (Throwable $e) {
            $styleOutput->error($e->getMessage());

            return false;
        }

        $styleOutput->success(sprintf(self::SUCCESS_MESSAGE_TEMPLATE, $generatedCount));

        return true;
    }

    protected function createGeneratorTransfer(
        InputInterface $input,
        SymfonyStyle $styleOutput,
    ): ?DefinitionGeneratorTransfer {
        $definitionPath = $this->getInputOption(self::OPTION_NAME_DEFINITION, $input, $styleOutput);
        $className = $this->getInputOption(self::OPTION_NAME_CLASS, $input, $styleOutput);
        $contentPath =  $this->getInputOption(self::OPTION_NAME_JSON, $input, $styleOutput);

        if ($definitionPath === null || $className === null || $contentPath === null) {
            return null;
        }

        $jsonContent = $this->getJsonContent($contentPath, $styleOutput);
        if ($jsonContent === []) {
            return null;
        }

        $generatorTransfer = new DefinitionGeneratorTransfer();
        $generatorTransfer->definitionPath = $definitionPath;

        $generatorTransfer->content = new DefinitionGeneratorContentTransfer();
        $generatorTransfer->content->className = $className;
        $generatorTransfer->content->content = $jsonContent;

        return $generatorTransfer;
    }

    /**
     * @return array<string,mixed>
     */
    protected function getJsonContent(string $contentPath, SymfonyStyle $styleOutput): array
    {
        try {
            $jsonContent = $this->generatorFacade->getJsonContent($contentPath);
        } catch (Throwable $e) {
            $styleOutput->error(
                sprintf(self::ERROR_MESSAGE_JSON_TEMPLATE, $contentPath, $e->getMessage()),
            );

            return [];
        }

        return $jsonContent;
    }
}
