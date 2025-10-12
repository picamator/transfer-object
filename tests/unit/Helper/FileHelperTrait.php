<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Helper;

trait FileHelperTrait
{
    /**
     * @var false|resource|null
     */
    private static $file = null;

    /**
     * @return false|resource
     */
    final protected static function openFile()
    {
        return self::$file ??= fopen(
            filename: 'data://text/plain;base64,',
            mode: 'r',
        );
    }

    final protected static function closeFile(): void
    {
        if (is_resource(self::$file)) {
            fclose(self::$file);
        }

        self::$file = null;
    }
}
