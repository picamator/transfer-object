<?php declare(strict_types=1);

namespace Picamator\TransferObject\Dependency;

use Picamator\TransferObject\Dependency\Exception\DependencyNotFoundTransferException;
use Psr\Container\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
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
     * @uses createFileSystem()
     * @uses createFinder()
     * @uses createYmlParser()
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\DependencyNotFoundTransferException
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new DependencyNotFoundTransferException(
                sprintf('Dependency "%s" not found.', $id),
            );
        }

        return static::{static::DEPENDENCIES[$id]}();
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, static::DEPENDENCIES);
    }

    protected static function createYmlParser(): Parser
    {
        static::$container[static::YML_PARSER] ??= new Parser();

        return static::$container[static::YML_PARSER];
    }

    /**
     * Finder does not reset internal state
     *
     * @see https://symfony.com/doc/current/components/finder.html
     */
    protected static function createFinder(): Finder
    {
        return new Finder();
    }

    protected static function createFileSystem(): Filesystem
    {
        static::$container[static::FILESYSTEM] ??= new Filesystem();

        return static::$container[static::FILESYSTEM];
    }
}
