<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Parser;

use Picamator\TransferObject\Shared\Parser\TypeDocBlock;

interface DocBlockParserInterface
{
    public function parseTypeWithDocBlock(string $type): TypeDocBlock;
}
