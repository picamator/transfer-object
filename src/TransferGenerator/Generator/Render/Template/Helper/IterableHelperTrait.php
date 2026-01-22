<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper;

trait IterableHelperTrait
{
    /**
     * @param iterable<int|string, string> $iterable
     */
    final protected function renderIterable(iterable $iterable, string $template): string
    {
        $rendered = '';
        foreach ($iterable as $item) {
            $rendered .= sprintf($template, $item);
        }

        return rtrim($rendered, PHP_EOL);
    }
}
