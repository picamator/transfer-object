<?php

declare(strict_types=1);

namespace Command;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Command\TransferGeneratorBulkCommand;
use Symfony\Component\Console\Tester\CommandTester;

#[Group('command')]
class TransferGeneratorBulkCommandTest extends TestCase
{
    private const string SUCCESS_CONFIG_LIST_PATH = '/tests/integration/Command/data/config/success/config.list.txt';

    private const string ERROR_CONFIG_EMPTY_LIST_PATH
        = '/tests/integration/Command/data/config/error/config.empty.list.txt';

    private const string ERROR_CONFIG_LIST_PATH = '/tests/integration/Command/data/config/error/config.list.txt';

    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $command = new TransferGeneratorBulkCommand();

        $this->commandTester = new CommandTester($command);
    }

    public function testRunCommandWithoutConfigurationShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('The required -b option is missing.', $output);
    }

    public function testRunCommandWithInvalidConfigurationPathShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute(['-b' => 'some-invalid-path.list.txt']);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('[ERROR] File', $output);
    }

    public function testRunCommandWithValidConfigurationShouldShowSuccessMessage(): void
    {
        // Act
        $this->commandTester->execute(
            ['-b' => self::SUCCESS_CONFIG_LIST_PATH],
        );
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->commandTester->assertCommandIsSuccessful();
        $this->assertStringContainsString('All Transfer Objects were generated successfully!', $output);
    }

    public function testRunCommandWithEmptyConfigurationShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute(
            ['-b' => self::ERROR_CONFIG_EMPTY_LIST_PATH],
        );
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('[ERROR] File size', $output);
    }

    public function testRunCommandWithValidConfigurationButInvalidDefinitionShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute(['-b' => self::ERROR_CONFIG_LIST_PATH]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString(
            'Property "run" type definition is missing or set multiple times.',
            $output,
        );
    }
}
