<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Command;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\FailedFiberTrait;
use Picamator\TransferObject\Command\TransferGeneratorCommand;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Tester\CommandTester;

#[Group('command')]
final class TransferGeneratorCommandTest extends TestCase
{
    use FailedFiberTrait;

    private const string SUCCESS_CONFIG_PATH
        = '/tests/integration/Command/data/config/success/generator.config.yml';

    private const string ERROR_CONFIG_PATH = '/tests/integration/Command/data/config/error/generator.config.yml';

    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $command = new TransferGeneratorCommand();
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
        $this->assertStringContainsString('The required -c option is missing.', $output);
    }

    #[TestDox('Run command with invalid configuration path should show error message')]
    public function testRunCommandWithInvalidConfigurationPathShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute(['-c' => 'some-invalid-path.config.yml']);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString('not exist.', $output);
    }

    #[TestDox('Run command with valid configuration should show success message')]
    public function testRunCommandWithValidConfigurationShouldShowSuccessMessage(): void
    {
        // Act
        $this->commandTester->execute(
            ['-c' => self::SUCCESS_CONFIG_PATH],
            ['verbosity' => OutputInterface::VERBOSITY_VERBOSE]
        );
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->commandTester->assertCommandIsSuccessful($output);
        $this->assertStringContainsString('command.transfer.yml: CommandFirstTransfer', $output);
        $this->assertStringContainsString('All Transfer Objects were generated successfully!', $output);
    }

    #[TestDox('Run command with valid configuration but invalid definition should show error message')]
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

    #[TestDox('Run command with valid configuration and failed fiber start should show error message')]
    public function testRunCommandWithValidConfigurationAndFailedFiberStartShouldShowErrorMessage(): void
    {
        // Arrange
        $generatorFacadeMock = $this->createMock(TransferGeneratorFacadeInterface::class);
        $fiber = $this->getFailedFiber();

        $command = new TransferGeneratorCommand($generatorFacadeMock);
        $commandTester = new CommandTester($command);

        // Expect
        $generatorFacadeMock->expects($this->once())
            ->method('getTransferGeneratorFiber')
            ->willReturn($fiber)
            ->seal();

        // Act
        $commandTester->execute(
            ['-c' => self::SUCCESS_CONFIG_PATH],
            ['verbosity' => OutputInterface::VERBOSITY_VERBOSE]
        );
        $output = $commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $commandTester->getStatusCode());
        $this->assertStringContainsString('Fiber cannot be started.', $output);
    }
}
