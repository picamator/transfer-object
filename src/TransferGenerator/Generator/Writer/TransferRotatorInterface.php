<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Writer;

interface TransferRotatorInterface
{
    public function rotateFiles(): void;
}
