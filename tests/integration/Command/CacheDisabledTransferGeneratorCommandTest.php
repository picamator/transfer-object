<?php

declare(strict_types=1);

namespace Command;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\EnvironmentTrait;
use Picamator\Tests\Integration\TransferObject\Helper\FileTrait;
use Picamator\TransferObject\Command\TransferGeneratorCommand;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Tester\CommandTester;

#[Group('command')]
final class CacheDisabledTransferGeneratorCommandTest extends TestCase
{
    use EnvironmentTrait;
    use FileTrait;

    private const string CONFIG_PATH
        = '/tests/integration/Command/data/config/success/generator.cache.disabled.config.yml';

    private const array GENERATED_FILES = [
        __DIR__ . '/Generated/Success/CommandCacheDisabledTransfer.php',
        __DIR__ . '/Generated/Success/transfer-object.cache.disabled.list.csv',
    ];

    private CommandTester $commandTester;

    public static function setUpBeforeClass(): void
    {
        self::turnOffCache();
    }

    public static function tearDownAfterClass(): void
    {
        self::turnOnCache();
    }

    protected function setUp(): void
    {
        $command = new TransferGeneratorCommand();
        $this->commandTester = new CommandTester($command);
    }

    #[TestDox('Run command with disabled cache should show always regenerate transfers')]
    public function testRunCommandWithDisabledCacheShouldAlwaysRegenerateTransfers(): void
    {
        // Arrange
        $modifiedTimesBefore = $this->getModifiedTimes(self::GENERATED_FILES);

        // Act
        $this->commandTester->execute(
            ['-c' => self::CONFIG_PATH],
            ['verbosity' => OutputInterface::VERBOSITY_VERBOSE]
        );
        $output = $this->commandTester->getDisplay();

        $modifiedTimesAfter = $this->getModifiedTimes(self::GENERATED_FILES);

        // Assert
        $this->commandTester->assertCommandIsSuccessful($output);
        $this->assertStringContainsString('command.transfer.yml: CommandCacheDisabled', $output);
        $this->assertStringContainsString('All Transfer Objects were generated successfully!', $output);

        $this->assertFilesExist(self::GENERATED_FILES);
        $this->assertNotSameModifiedTimes($modifiedTimesBefore, $modifiedTimesAfter);
    }
}
