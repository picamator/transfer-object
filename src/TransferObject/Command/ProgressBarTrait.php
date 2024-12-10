<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

trait ProgressBarTrait
{
    private SymfonyStyle $symfonyStyle;

    private string $definitionFileName;

    protected function progressStart(InputInterface $input, OutputInterface $output, int $maxSteps): void
    {
        $this->symfonyStyle ??= new SymfonyStyle($input, $output);
        $this->symfonyStyle->title('Starting progress');
        $this->symfonyStyle->progressStart($maxSteps);
        $this->symfonyStyle->newLine();
    }

    protected function progressAdvance(string $definitionKey): void
    {
        $definitionFile = strstr($definitionKey, ':', true);

        $this->definitionFileName ??= $definitionFile;
        if ($this->definitionFileName === $definitionFile) {
            return;
        }

        $this->definitionFileName = $definitionFile;
        $this->symfonyStyle->progressAdvance();
        $this->symfonyStyle->newLine();
    }

    protected function progressFinish(): void
    {
        $this->symfonyStyle->progressFinish();
    }
}
