<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Command\Helper\InputNormalizerTrait;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacadeInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilderInterface;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'picamator:definition:generate',
    description: 'Generates Transfer Object definition files from a JSON blueprint.',
    aliases: ['p:d:g'],
    hidden: false
)]
class DefinitionGeneratorCommand extends Command
{
    use InputNormalizerTrait;

    /**
     * phpcs:disable Generic.Files.LineLength
     */
    private const string HELP = <<<'HELP'
This command generates Transfer Object definition files based on a JSON file as a blueprint.

<options=bold>Interactive prompt options:</>
  - Specify the directory path where the definition files will be saved.
  - Provide the class name for the Transfer Object.
  - Enter the local path or URL to the JSON file that serves as the blueprint.

<options=bold>Documentation:</>
For more details, please visit "<href=https://github.com/picamator/transfer-object/wiki/Console-Commands#definition-generate>project's Wiki</>".

HELP;

    private const string QUESTION_DEFINITION_PATH = 'Definition directory path: ';
    private const string QUESTION_CLASS_NAME = 'Transfer Object class name: ';
    private const string QUESTION_JSON_PATH = 'JSON local path or url: ';

    private const string START_SECTION_NAME = 'Generating Transfer Object Definitions ✨';

    private const string SUCCESS_MESSAGE_TEMPLATE = 'Successfully generated %d definition file(s)! 🎉';

    public function __construct(
        ?string $name = null,
        private readonly DefinitionGeneratorFacadeInterface $generatorFacade = new DefinitionGeneratorFacade(),
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setHelp(help: self::HELP);
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
        $builder = $this->generatorFacade->createDefinitionGeneratorBuilder();
        $helper = $this->getQuestionHelper();

        // definition path
        $question = $this->createDefinitionPathQuestion($builder);
        $helper->ask($input, $styleOutput, $question);

        // class name
        $question = $this->createClassNameQuestion($builder);
        $helper->ask($input, $styleOutput, $question);

        // JSON path
        $question = $this->createJsonPathQuestion($builder);
        $helper->ask($input, $styleOutput, $question);

        return $builder->build();
    }

    private function createJsonPathQuestion(DefinitionGeneratorBuilderInterface $builder): Question
    {
        return new Question(question: self::QUESTION_JSON_PATH)
            ->setValidator(function (string $answer) use ($builder) {
                $builder->setJsonPath($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizePath(...));
    }

    private function createClassNameQuestion(DefinitionGeneratorBuilderInterface $builder): Question
    {
        return new Question(question: self::QUESTION_CLASS_NAME)
            ->setValidator(function (string $answer) use ($builder) {
                $builder->setClassName($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizeInput(...));
    }

    private function createDefinitionPathQuestion(DefinitionGeneratorBuilderInterface $builder): Question
    {
        return new Question(question: self::QUESTION_DEFINITION_PATH)
            ->setValidator(function (string $answer) use ($builder) {
                $builder->setDefinitionPath($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizePath(...));
    }

    private function getQuestionHelper(): QuestionHelper
    {
        /** @var \Symfony\Component\Console\Helper\QuestionHelper $helper */
        $helper = $this->getHelper(name: 'question');

        return $helper;
    }
}
