<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacadeInterface;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

class DefinitionGeneratorCommand extends Command
{
    private const string NAME = 'picamator:definition:generate';
    private const string DESCRIPTION = 'Generate Transfer Object definition files from a JSON blueprint.';
    private const string HELP = <<<'HELP'
This command allows you to generate Transfer Object definition files based on a JSON file as a blueprint.

You will be prompted to provide the following details:
  - The directory path where the definition files should be saved.
  - The class name for the Transfer Object.
  - The path to the JSON file that serves as a blueprint.

Follow the interactive prompts to complete the process.
HELP;

    private const string QUESTION_DEFINITION_PATH = 'Definition directory path: ';
    private const string QUESTION_CLASS_NAME = 'Transfer Object class name: ';
    private const string QUESTION_JSON_PATH = 'JSON file path: ';

    private const string START_SECTION_NAME = 'Generating Transfer Object Definitions...';

    private const string SUCCESS_MESSAGE_TEMPLATE = 'Successfully generated %d definition file(s)!';

    public function __construct(
        ?string $name = null,
        private readonly DefinitionGeneratorFacadeInterface $generatorFacade = new DefinitionGeneratorFacade(),
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        if ($this->getName() === null) {
            $this->setName(name: self::NAME);
        }

        $this->setDescription(description: self::DESCRIPTION)
            ->setHelp(help: self::HELP);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $styleOutput = new SymfonyStyle($input, $output);
        $styleOutput->section(self::START_SECTION_NAME);

        $generatorTransfer = $this->createGeneratorTransfer($input, $styleOutput);

        try {
            $generatedCount = $this->generatorFacade->generateDefinitionsOrFail($generatorTransfer);
        } catch (Throwable $e) {
            $styleOutput->error($e->getMessage());

            return Command::FAILURE;
        }

        $styleOutput->success(sprintf(self::SUCCESS_MESSAGE_TEMPLATE, $generatedCount));

        return Command::SUCCESS;
    }

    private function createGeneratorTransfer(
        InputInterface $input,
        SymfonyStyle $styleOutput,
    ): DefinitionGeneratorTransfer {
        $generatorBuilder = $this->generatorFacade->createDefinitionGeneratorBuilder();

        /** @var \Symfony\Component\Console\Helper\QuestionHelper $helper */
        $helper = $this->getHelper(name: 'question');

        // definition path
        $definitionPathQuestion = new Question(question: self::QUESTION_DEFINITION_PATH)
            ->setValidator(function (string $answer) use ($generatorBuilder) {
                $generatorBuilder->setDefinitionPath($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizePath(...));

        $helper->ask($input, $styleOutput, $definitionPathQuestion);

        // class name
        $classNameQuestion = new Question(question: self::QUESTION_CLASS_NAME)
            ->setValidator(function (string $answer) use ($generatorBuilder) {
                $generatorBuilder->setClassName($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizeEmpty(...));

        $helper->ask($input, $styleOutput, $classNameQuestion);

        // JSON path
        $jsonPathQuestion = new Question(question: self::QUESTION_JSON_PATH)
            ->setValidator(function (string $answer) use ($generatorBuilder) {
                $generatorBuilder->setJsonPath($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizePath(...));

        $helper->ask($input, $styleOutput, $jsonPathQuestion);

        return $generatorBuilder->build();
    }

    private function normalizePath(?string $value): string
    {
        $value = $this->normalizeEmpty($value);
        if ($value === '') {
            return '';
        }

        $workingDirectory = getcwd() ?: '';
        $value = ltrim($value, '\/');

        return $workingDirectory . DIRECTORY_SEPARATOR . $value;
    }

    private function normalizeEmpty(?string $value): string
    {
        return $value ? trim($value) : '';
    }
}
