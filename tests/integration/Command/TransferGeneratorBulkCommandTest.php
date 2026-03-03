<?php

declare(strict_types=1);

namespace Command;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\FailedFiberTrait;
use Picamator\Tests\Integration\TransferObject\Helper\FileTrait;
use Picamator\TransferObject\Command\TransferGeneratorBulkCommand;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\Tester\CommandTester;

#[Group('command')]
final class TransferGeneratorBulkCommandTest extends TestCase
{
    use FailedFiberTrait;
    use FileTrait;

    private const string SUCCESS_CONFIG_LIST_PATH = '/tests/integration/Command/data/config/success/config.list.txt';

    private const array SUCCESS_GENERATED_FILES = [
        __DIR__ . '/Generated/Success/CommandBulkFirstTransfer.php',
        __DIR__ . '/Generated/Success/CommandBulkSecondTransfer.php',
        __DIR__ . '/Generated/Success/CommandBulkThirdTransfer.php',
        __DIR__ . '/Generated/Success/0522db555dcdc49fa936ab8d1d3345d16a865d7c.transfer.hash.csv',
        __DIR__ . '/Generated/Success/660b282118a23a83dc1e5b63e91f543eb7ccfedb.transfer.hash.csv',
    ];

    private const string ERROR_CONFIG_EMPTY_LIST_PATH
        = '/tests/integration/Command/data/config/error/config.empty.list.txt';

    private const string ERROR_CONFIG_LIST_PATH = '/tests/integration/Command/data/config/error/config.list.txt';

    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $command = new TransferGeneratorBulkCommand();
        $this->commandTester = new CommandTester($command);
    }

    #[TestDox('Run command without configuration should show error message')]
    public function testRunCommandWithoutConfigurationShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(2, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('The required -b option is missing.', $output);
    }

    #[TestDox('Run command with invalid configuration path should show error message')]
    public function testRunCommandWithInvalidConfigurationPathShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute(['-b' => 'some-invalid-path.list.txt']);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('[ERROR] File', $output);
    }

    #[TestDox('Run command with valid configuration should show success message')]
    public function testRunCommandWithValidConfigurationShouldShowSuccessMessage(): void
    {
        // Act
        $this->commandTester->execute(
            ['-b' => self::SUCCESS_CONFIG_LIST_PATH],
        );
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->commandTester->assertCommandIsSuccessful($output);
        $this->assertStringContainsString('All Transfer Objects were generated successfully!', $output);
        $this->assertFilesExist(self::SUCCESS_GENERATED_FILES);
    }

    #[TestDox('Run command with empty configuration should show error message')]
    public function testRunCommandWithEmptyConfigurationShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute(
            ['-b' => self::ERROR_CONFIG_EMPTY_LIST_PATH],
        );
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('empty', $output);
    }

    #[TestDox('Run command with valid configuration but invalid definition should show error message')]
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

    #[TestDox('Run command with valid configuration and failed fiber start should show error message')]
    public function testRunCommandWithValidConfigurationAndFailedFiberStartShouldShowErrorMessage(): void
    {
        // Arrange
        $generatorFacadeMock = $this->createMock(TransferGeneratorFacadeInterface::class);
        $fiber = $this->getFailedFiber();

        $command = new TransferGeneratorBulkCommand($generatorFacadeMock);
        $commandTester = new CommandTester($command);

        // Expect
        $generatorFacadeMock->expects($this->once())
            ->method('getTransferGeneratorBulkFiber')
            ->willReturn($fiber)
            ->seal();

        // Act
        $commandTester->execute(
            ['-b' => self::SUCCESS_CONFIG_LIST_PATH],
        );
        $output = $commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $commandTester->getStatusCode());
        $this->assertStringContainsString('Fiber cannot be started.', $output);
    }
}
