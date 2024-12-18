<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Generator;

interface GeneratorFiberCallbackInterface
{
    public function fiberCallback(): bool;
}
