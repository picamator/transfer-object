<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Render;

use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

readonly class ErrorMessageRender implements ErrorMessageRenderInterface
{
    private const string ERROR_MESSAGE = 'Failed to generate Transfer Objects.';

    private const string TRANSFER_MESSAGE_TEMPLATE = 'Transfer Object: "%s".';
    private const string DEFINITION_MESSAGE_TEMPLATE = 'Definition file: "%s".';

    public function render(TransferGeneratorTransfer $generatorTransfer): string
    {
        /** array<int, string> $messageParts */
        $messageParts[] = self::ERROR_MESSAGE;
        $this->expandTransferMessage($generatorTransfer, $messageParts);
        $this->expandDefinitionMessage($generatorTransfer, $messageParts);
        $messageParts[] = PHP_EOL;

        $this->expandErrorMessages($generatorTransfer, $messageParts);

        return implode(PHP_EOL, $messageParts);
    }

    /**
     * @param array<int, string> $messageParts
     */
    private function expandErrorMessages(TransferGeneratorTransfer $generatorTransfer, array &$messageParts): void
    {
        foreach ($generatorTransfer->validator->errorMessages as $message) {
            $messageParts[] = $message->errorMessage;
        }
    }

    /**
     * @param array<int, string> $messageParts
     */
    private function expandDefinitionMessage(TransferGeneratorTransfer $generatorTransfer, array &$messageParts): void
    {
        if ($generatorTransfer->fileName === null) {
            return;
        }

        $messageParts[] = sprintf(self::DEFINITION_MESSAGE_TEMPLATE, $generatorTransfer->fileName);
    }

    /**
     * @param array<int, string> $messageParts
     */
    private function expandTransferMessage(TransferGeneratorTransfer $generatorTransfer, array &$messageParts): void
    {
        if ($generatorTransfer->className === null) {
            return;
        }

        $messageParts[] = sprintf(self::TRANSFER_MESSAGE_TEMPLATE, $generatorTransfer->className);
    }
}
