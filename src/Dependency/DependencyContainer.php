<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency;

use Picamator\TransferObject\Dependency\Exception\ServiceNotFoundException;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemBridge;
use Picamator\TransferObject\Dependency\Finder\FinderBridge;
use Picamator\TransferObject\Dependency\YmlParser\YmlParserBridge;
use Psr\Container\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Parser;

class DependencyContainer implements ContainerInterface
{
    public const string FILESYSTEM = 'filesystem';
    public const string FINDER = 'finder';
    public const string YML_PARSER = 'ymlParser';

    protected const array DEPENDENCIES = [
        self::FILESYSTEM => 'createFileSystem',
        self::FINDER => 'createFinder',
        self::YML_PARSER => 'createYmlParser',
    ];

    /**
     * @var array<string,mixed>
     */
    protected static array $container = [];

    /**
     * @uses static::createFinder()
     * @uses static::createFileSystem()
     * @uses static::createYmlParser()
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\ServiceNotFoundException
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new ServiceNotFoundException(
                sprintf('Dependency "%s" not found.', $id),
            );
        }

        return static::{static::DEPENDENCIES[$id]}();
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, static::DEPENDENCIES);
    }

    protected static function createYmlParser(): mixed
    {
        static::$container[static::YML_PARSER] ??= new YmlParserBridge(new Parser());

        return static::$container[static::YML_PARSER];
    }

    protected static function createFinder(): mixed
    {
        static::$container[static::FINDER] ??= new FinderBridge();

        return static::$container[static::FINDER];
    }

    protected static function createFileSystem(): mixed
    {
        static::$container[static::FILESYSTEM] ??= new FilesystemBridge(new Filesystem());

        return static::$container[static::FILESYSTEM];
    }
}
