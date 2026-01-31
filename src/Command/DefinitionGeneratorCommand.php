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
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'picamator:definition:generate|p:d:g',
    description: 'Generates Transfer Object definition files from a JSON blueprint.',
    // phpcs:disable Generic.Files.LineLength
    help: <<<'HELP'
The <info>%command.name%</info> command generates Transfer Object definition files based on a JSON blueprint.

<options=bold>Interactive prompt options:</>
  - Specify the directory path where the definition files will be saved.
  - Provide the class name for the Transfer Object.
  - Enter the local path to the JSON file or API resource that serves as the blueprint.

<options=bold>Documentation:</>
For more details, please visit "<href=https://github.com/picamator/transfer-object/wiki/Console-Commands#definition-generate>project's Wiki</>".

HELP
)]
readonly class DefinitionGeneratorCommand
{
    use InputNormalizerTrait;

    private const string QUESTION_DEFINITION_PATH = 'Definition directory path: ';
    private const string QUESTION_CLASS_NAME = 'Transfer Object class name: ';
    private const string QUESTION_JSON_PATH = 'JSON local path or url: ';

    private const string START_SECTION_NAME = 'Generating Transfer Object Definitions ✨';

    private const string SUCCESS_MESSAGE_TEMPLATE = 'Successfully generated %d definition file(s)! 🎉';

    public function __construct(
        private DefinitionGeneratorFacadeInterface $generatorFacade = new DefinitionGeneratorFacade(),
    ) {
    }

    public function __invoke(SymfonyStyle $io): int
    {
        $io->section(self::START_SECTION_NAME);

        $generatorTransfer = $this->createGeneratorTransfer($io);

        try {
            $generatedCount = $this->generatorFacade->generateDefinitionsOrFail($generatorTransfer);
        } catch (Throwable $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        $io->success(sprintf(self::SUCCESS_MESSAGE_TEMPLATE, $generatedCount));

        return Command::SUCCESS;
    }

    private function createGeneratorTransfer(SymfonyStyle $io): DefinitionGeneratorTransfer
    {
        $builder = $this->generatorFacade->createDefinitionGeneratorBuilder();

        // definition path
        $question = $this->createDefinitionPathQuestion($builder);
        $io->askQuestion($question);

        // class name
        $question = $this->createClassNameQuestion($builder);
        $io->askQuestion($question);

        // JSON path
        $question = $this->createJsonPathQuestion($builder);
        $io->askQuestion($question);

        return $builder->build();
    }

    private function createJsonPathQuestion(DefinitionGeneratorBuilderInterface $builder): Question
    {
        return new Question(question: self::QUESTION_JSON_PATH)
            /** @phpstan-ignore argument.type */
            ->setValidator(function (string $answer) use ($builder): string {
                $builder->setJsonPath($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizePath(...));
    }

    private function createClassNameQuestion(DefinitionGeneratorBuilderInterface $builder): Question
    {
        return new Question(question: self::QUESTION_CLASS_NAME)
            /** @phpstan-ignore argument.type */
            ->setValidator(function (string $answer) use ($builder): string {
                $builder->setClassName($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizeInput(...));
    }

    private function createDefinitionPathQuestion(DefinitionGeneratorBuilderInterface $builder): Question
    {
        return new Question(question: self::QUESTION_DEFINITION_PATH)
            /** @phpstan-ignore argument.type */
            ->setValidator(function (string $answer) use ($builder): string {
                $builder->setDefinitionPath($answer);

                return $answer;
            })
            ->setTrimmable(trimmable: true)
            ->setNormalizer($this->normalizePath(...));
    }
}
