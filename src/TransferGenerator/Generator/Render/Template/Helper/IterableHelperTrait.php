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
        $renderedIterable = '';
        foreach ($iterable as $item) {
            $renderedIterable .= sprintf($template, $item);
        }

        return rtrim($renderedIterable, PHP_EOL);
    }
}
