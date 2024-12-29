<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Command;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Command\TransferGeneratorCommand;
use Symfony\Component\Console\Tester\CommandTester;

class TransferGeneratorCommandTest extends TestCase
{
    private const string SUCCESS_CONFIG_PATH = __DIR__ . '/data/success/config/generator.config.yml';
    private const string ERROR_CONFIG_PATH = __DIR__ . '/data/error/config/generator.config.yml';

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
        $this->assertStringContainsString('Command option -c is not set', $output);
    }

    public function testRunCommandWithInvalidConfigurationPathShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute([
            '-c' => 'some-invalid-path.config.yml'
        ]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('Configuration file "some-invalid-path.config.yml" does not exist.', $output);
    }

    public function testRunCommandWithValidConfigurationShouldShowSuccessMessage(): void
    {
        // Act
        $this->commandTester->execute([
            '-c' => self::SUCCESS_CONFIG_PATH,
        ]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->commandTester->assertCommandIsSuccessful();
        $this->assertStringContainsString('Transfer Objects successfully generated.', $output);
    }

    public function testRunCommandWithValidConfigurationButInvalidDefinitionShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute([
            '-c' => self::ERROR_CONFIG_PATH,
        ]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('Failed to generate Transfer Objects.', $output);
    }
}
