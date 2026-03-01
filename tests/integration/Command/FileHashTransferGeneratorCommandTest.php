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
final class FileHashTransferGeneratorCommandTest extends TestCase
{
    use EnvironmentTrait;
    use FileTrait;

    private const string CONFIG_PATH
        = '/tests/integration/Command/data/config/success/generator.file.hash.config.yml';

    private const string HASH_FILE_PATH = __DIR__ . '/Generated/Success/transfer-object.file.hash.list.csv';

    private const string HASH_FILE_CONTENT = <<<'CONTENT'
CommandFileHashTransfer,some-hash-1
CommandFileHashToDeleteTransfer,some-hash-2
CONTENT;

    private const string TRANSFER_TO_UPDATE_PATH =
        __DIR__ . '/Generated/Success/CommandFileHashTransfer.php';

    private const string TRANSFER_TO_DELETE_PATH =
        __DIR__ . '/Generated/Success/CommandFileHashToDeleteTransfer.php';

    private const array SUCCESS_GENERATED_FILES = [
        self::TRANSFER_TO_UPDATE_PATH,
        self::HASH_FILE_PATH,
    ];

    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $command = new TransferGeneratorCommand();
        $this->commandTester = new CommandTester($command);
    }

    #[TestDox('Generate transfer objects where the file hash was changed and one to delete should rotate the files')]
    public function testRunCommandWithHashFileChangeIncludeFileToDeleteShouldRotateTheFiles(): void
    {
        // Arrange
        $this->saveFileContent(self::HASH_FILE_PATH, self::HASH_FILE_CONTENT);
        $this->createEmptyFile(self::TRANSFER_TO_DELETE_PATH);

        $transferModifiedTimeBefore = $this->getModifiedTime(self::TRANSFER_TO_UPDATE_PATH);

        // Act
        $this->commandTester->execute(
            ['-c' => self::CONFIG_PATH],
            ['verbosity' => OutputInterface::VERBOSITY_VERBOSE]
        );
        $output = $this->commandTester->getDisplay();

        $transferModifiedTimeAfter = $this->getModifiedTime(self::TRANSFER_TO_UPDATE_PATH);

        // Assert
        $this->commandTester->assertCommandIsSuccessful($output);
        $this->assertStringContainsString('command.transfer.yml: CommandFileHashTransfer', $output);
        $this->assertStringContainsString('All Transfer Objects were generated successfully!', $output);

        $this->assertFilesExist(self::SUCCESS_GENERATED_FILES);
        $this->assertNotSameModifiedTime($transferModifiedTimeBefore, $transferModifiedTimeAfter);
        $this->assertFileDoesNotExist(
            self::TRANSFER_TO_DELETE_PATH,
            'The file should be deleted',
        );
    }
}
