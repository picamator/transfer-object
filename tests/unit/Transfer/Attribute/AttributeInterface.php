<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Transfer\Attribute;

use Picamator\TransferObject\Transfer\Attribute\Initiator\InitiatorAttributeInterface;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransformerAttributeInterface;

interface AttributeInterface
{
    public const string SOME_CONSTANT_WITHOUT_ATTRIBUTE = 'SOME_CONSTANT_WITHOUT_ATTRIBUTE';

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\AttributeTransferException
     */
    public function getInitiatorAttribute(string $constantName): InitiatorAttributeInterface;

    /**
     * @throws \Picamator\TransferObject\Transfer\Exception\AttributeTransferException
     */
    public function getTransformerAttribute(string $constantName): TransformerAttributeInterface;
}
