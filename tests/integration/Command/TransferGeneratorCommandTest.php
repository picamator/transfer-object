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

    private const string GENERATED_TEMP_PATH = __DIR__ . '/Generated/_tmp';

    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $command = new TransferGeneratorCommand();

        $this->commandTester = new CommandTester($command);
    }

    protected function tearDown(): void
    {
        if (is_dir(self::GENERATED_TEMP_PATH)) {
            rmdir(self::GENERATED_TEMP_PATH);
        }
    }

    public function testRunCommandWithoutConfigurationShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('Command\'s option -c is not set', $output);
    }

    public function testRunCommandWithInvalidConfigurationShouldShowErrorMessage(): void
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

    public function testRunCommandWithErrorConfigurationShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute([
            '-c' => self::ERROR_CONFIG_PATH,
        ]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('Failed generate Transfer Objects.', $output);
    }
}
