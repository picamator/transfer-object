<?php declare(strict_types=1);

namespace Picamator\TransferObject\Dependency;

use Picamator\TransferObject\Exception\DependencyNotFoundTransferException;
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
        self::FILESYSTEM => Filesystem::class,
        self::FINDER => Finder::class,
        self::YML_PARSER => Parser::class,
    ];

    /**
     * @var array<string,mixed>
     */
    private static array $container = [];

    /**
     * @throws \Picamator\TransferObject\Exception\DependencyNotFoundTransferException
     */
    public function get(string $id): mixed
    {
        if (!$this->has($id)) {
            throw new DependencyNotFoundTransferException(
                sprintf('Dependency "%s" not found.', $id),
            );
        }

        return new (static::DEPENDENCIES[$id]);
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, static::DEPENDENCIES);
    }
}
