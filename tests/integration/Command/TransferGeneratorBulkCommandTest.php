<?php

declare(strict_types=1);

namespace Command;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\FailedFiberTrait;
use Picamator\TransferObject\Command\TransferGeneratorBulkCommand;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;
use Symfony\Component\Console\SingleCommandApplication;
use Symfony\Component\Console\Tester\CommandTester;

#[Group('command')]
class TransferGeneratorBulkCommandTest extends TestCase
{
    use FailedFiberTrait;

    private const string SUCCESS_CONFIG_LIST_PATH = '/tests/integration/Command/data/config/success/config.list.txt';

    private const string ERROR_CONFIG_EMPTY_LIST_PATH
        = '/tests/integration/Command/data/config/error/config.empty.list.txt';

    private const string ERROR_CONFIG_LIST_PATH = '/tests/integration/Command/data/config/error/config.list.txt';

    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $application = new SingleCommandApplication()
            ->setCode(code: new TransferGeneratorBulkCommand())
            ->setAutoExit(autoExit: false);

        $this->commandTester = new CommandTester($application);
    }

    #[TestDox('Run command without configuration should show error message')]
    public function testRunCommandWithoutConfigurationShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
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
        $this->commandTester->assertCommandIsSuccessful();
        $this->assertStringContainsString('All Transfer Objects were generated successfully!', $output);
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
        $this->assertStringContainsString('[ERROR] File size', $output);
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

        $application = new SingleCommandApplication()
            ->setCode(code: new TransferGeneratorBulkCommand($generatorFacadeMock))
            ->setAutoExit(autoExit: false);

        $commandTester = new CommandTester($application);

        // Expect
        $generatorFacadeMock->expects($this->once())
            ->method('getTransferGeneratorBulkFiber')
            ->willReturn($fiber);

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
