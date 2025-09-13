<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Command;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Command\TransferGeneratorCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Tester\CommandTester;

#[Group('command')]
class TransferGeneratorCommandTest extends TestCase
{
    private const string SUCCESS_CONFIG_PATH = '/tests/integration/Command/data/config/success/generator.config.yml';
    private const string ERROR_CONFIG_PATH = '/tests/integration/Command/data/config/error/generator.config.yml';

    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $command = new TransferGeneratorCommand();

        $this->commandTester = new CommandTester($command);
    }

    public function testRunCommandWithoutConfigurationShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('The required -c option is missing.', $output);
    }

    public function testRunCommandWithInvalidConfigurationPathShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute(['-c' => 'some-invalid-path.config.yml']);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('not exist.', $output);
    }

    public function testRunCommandWithValidConfigurationShouldShowSuccessMessage(): void
    {
        // Act
        $this->commandTester->execute(
            ['-c' => self::SUCCESS_CONFIG_PATH],
            ['verbosity' => OutputInterface::VERBOSITY_VERBOSE]
        );
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->commandTester->assertCommandIsSuccessful();
        $this->assertStringContainsString('command.transfer.yml: CommandTransfer', $output);
        $this->assertStringContainsString('All Transfer Objects were generated successfully!', $output);
    }

    public function testRunCommandWithValidConfigurationButInvalidDefinitionShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute(['-c' => self::ERROR_CONFIG_PATH]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString(
            '[ERROR] Property "run" type definition is missing or set multiple times.',
            $output,
        );
    }
}
