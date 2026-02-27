<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Environment;

use Picamator\TransferObject\Shared\Environment\Enum\EnvironmentEnum;

readonly class EnvironmentReader implements EnvironmentReaderInterface
{
    public function getProjectRoot(): string
    {
        $projectRoot = $this->getEnvironment(@EnvironmentEnum::PROJECT_ROOT)
            ?: $this->getEnvironment(@EnvironmentEnum::PROJECT_ROOT_ALIAS);

        if ($projectRoot === '') {
            return $this->getcwd() ?: '';
        }

        $projectRoot = trim($projectRoot);

        return rtrim($projectRoot, '\/');
    }

    public function getMaxFileSizeMegabytes(): int
    {
        $environment = EnvironmentEnum::MAX_FILE_SIZE_MB;
        $maxFileSize = (int)$this->getEnvironment($environment);

        if ($maxFileSize === 0) {
            $maxFileSize = (int)$environment->getDefault();
        }

        /** @var int $maxFileSize */
        $maxFileSize = min($maxFileSize, 1024);

        return $maxFileSize;
    }

    public function getMaxFileSizeBytes(): int
    {
        return $this->getMaxFileSizeMegabytes() * 1_000_000;
    }

    public function getIsCacheEnabled(): bool
    {
        $isCacheEnabled = $this->getEnvironment(EnvironmentEnum::IS_CACHE_ENABLED);

        return $isCacheEnabled === '1'
            || $isCacheEnabled === 'true'
            || $isCacheEnabled === 'TRUE';
    }

    private function getEnvironment(EnvironmentEnum $environment): string
    {
        $value = $this->getenv($environment->value);
        if (is_string($value)) {
            return $value;
        }

        return $environment->getDefault();
    }

    /**
     * @return array<int, string>|false|string
     */
    protected function getenv(string $name): array|false|string
    {
        return getenv($name);
    }

    protected function getcwd(): false|string
    {
        return getcwd();
    }
}
