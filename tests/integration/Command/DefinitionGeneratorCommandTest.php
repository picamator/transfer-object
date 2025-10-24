<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Command;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Command\DefinitionGeneratorCommand;
use Symfony\Component\Console\SingleCommandApplication;
use Symfony\Component\Console\Tester\CommandTester;

#[Group('command')]
class DefinitionGeneratorCommandTest extends TestCase
{
    private CommandTester $commandTester;

    protected function setUp(): void
    {
        $application = new SingleCommandApplication()
            ->setCode(code: new DefinitionGeneratorCommand())
            ->setAutoExit(autoExit: false);

        $this->commandTester = new CommandTester($application);
    }

    #[TestDox('Run command with valid json should show success message')]
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
        $this->assertStringContainsString('Successfully generated 1 definition file(s)!', $output);
        $this->assertFileExists(__DIR__ . '/Generated/Definition/Success/customer.transfer.yml');
    }

    #[TestDox('Run command with invalid json should show error message')]
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
        $this->assertStringContainsString('[ERROR] Invalid property name "0".', $output);
    }
}
