<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Command;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Command\DefinitionGeneratorCommand;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Tester\CommandTester;

class DefinitionGeneratorCommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $helperSet = new HelperSet();
        $helperSet->set(new QuestionHelper(), 'question');

        $command = new DefinitionGeneratorCommand();
        $command->setHelperSet($helperSet);

        $this->commandTester = new CommandTester($command);
    }

    public function testRunCommandWithValidJsonShouldShowSuccessMessage(): void
    {
        // Act
        $this->commandTester->setInputs([
            '/tests/integration/Command/Generated/Definition/Success',
            'Customer',
            '/tests/integration/Command/data/api-response/success/customer.json',
        ]);

        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertStringContainsString(
            'Successfully generated 1 definition file(s)!',
            $output,
        );
        $this->assertFileExists(__DIR__ . '/Generated/Definition/Success/customer.transfer.yml');
    }

    public function testRunCommandWithInvalidJsonShouldShowErrorMessage(): void
    {
        // Act
        $this->commandTester->setInputs([
            '/tests/integration/Command/Generated/Definition/Error',
            'Customer',
            '/tests/integration/Command/data/api-response/error/customer.json',
        ]);

        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        // Assert
        $this->assertSame(1, $this->commandTester->getStatusCode());
        $this->assertStringContainsString(
            '[ERROR] Invalid property name "0".',
            $output,
        );
    }
}
