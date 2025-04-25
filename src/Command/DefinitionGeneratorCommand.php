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

final class DefinitionGeneratorCommand extends Command
{
    private const string NAME = 'definition:generate';
    private const string DESCRIPTION = 'Generates Transfer Object definition files.';
    private const string HELP = <<<'HELP'
Based on JSON file, generates Transfer Object definition files.
HELP;

    private const string QUESTION_DEFINITION_PATH = 'Please enter path to the Definition directory: ';
    private const string QUESTION_DEFAULT_DEFINITION_PATH = '/config/definition';

    private const string QUESTION_CLASS_NAME = 'Please enter the Transfer Object class name: ';

    private const string QUESTION_JSON_PATH = 'Please enter path to the JSON file: ';

    private const string START_SECTION_NAME = 'Definition Generation';

    private const string SUCCESS_MESSAGE_TEMPLATE = 'Definition files %d were generated successfully.';

    public function __construct(
        ?string $name = null,
        private readonly DefinitionGeneratorFacadeInterface $generatorFacade = new DefinitionGeneratorFacade(),
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->setHelp(self::HELP);
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
        $helper = $this->getHelper('question');

        // definition path
        $definitionPathQuestion = new Question(
            self::QUESTION_DEFINITION_PATH,
            self::QUESTION_DEFAULT_DEFINITION_PATH
        )->setValidator(function (string $answer) use ($generatorBuilder) {
            $answer = $this->getFullPath($answer);
            $generatorBuilder->setDefinitionPath($answer);

            return $answer;
        });

        $helper->ask($input, $styleOutput, $definitionPathQuestion);

        // class name
        $classNameQuestion = new Question(self::QUESTION_CLASS_NAME)
            ->setValidator(function (string $answer) use ($generatorBuilder) {
                $generatorBuilder->setClassName($answer);

                return $answer;
            });

        $helper->ask($input, $styleOutput, $classNameQuestion);

        // JSON path
        $jsonPathQuestion = new Question(self::QUESTION_JSON_PATH)
            ->setValidator(function (string $answer) use ($generatorBuilder) {
                $answer = $this->getFullPath($answer);
                $generatorBuilder->setJsonPath($answer);

                return $answer;
            });

        $helper->ask($input, $styleOutput, $jsonPathQuestion);

        return $generatorBuilder->build();
    }

    private function getFullPath(string $path): string
    {
        $workingDirectory = getcwd() ?: '';
        $path = ltrim($path, '\/');

        return $workingDirectory . DIRECTORY_SEPARATOR . $path;
    }
}
