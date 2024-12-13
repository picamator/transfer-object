<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Command;

use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\DefinitionPathTransfer;
use Picamator\TransferObject\Generated\GeneratedPathTransfer;
use Picamator\TransferObject\Generated\GeneratorTransfer;
use Picamator\TransferObject\Generator\GeneratorFacade;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GeneratorCommand extends Command
{
    use GeneratorWritelnTrait;

    private const string NAME = 'generate:transfer';
    private const string DESCRIPTION = 'Generates Transfer Objects based on definitions.';
    private const string HELP = 'In order to generate Transfer Objects path to configuration should be provided. Please check "config/generator/config.yml.dist".';

    protected function configure(): void
    {
        $this->setName(static::NAME)
            ->setDescription(static::DESCRIPTION)
            ->setHelp(static::HELP);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $configTransfer = new ConfigTransfer()
            ->fromArray([
                ConfigTransfer::CLASS_NAMESPACE => 'Picamator\TransferObject\Generated',
                ConfigTransfer::DEFINITION_PATH => [
                    DefinitionPathTransfer::PATH => __DIR__ . DIRECTORY_SEPARATOR . 'config/definition',
                ],
                ConfigTransfer::GENERATED_PATH => [
                    GeneratedPathTransfer::PATH => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Generated',
                ],
            ]);

        $errorItemCallback = fn(GeneratorTransfer $generatorTransfer) => $this->writelnGeneratorTransfer($generatorTransfer, $output);
        $isSuccess = new GeneratorFacade()->generateTransfers($configTransfer, $errorItemCallback);

        if ($isSuccess) {
            $this->writelnSuccess($output, static::SUCCESS_MESSAGE);

            return Command::SUCCESS;
        }

        $this->writelnError($output, static::FAILED_MESSAGE);

        return Command::FAILURE;
    }
}

