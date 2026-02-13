<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render;

use Picamator\TransferObject\Generated\TemplateTransfer;

readonly class TemplateSorter implements TemplateSorterInterface
{
    public function sortTemplateTransfer(TemplateTransfer $templateTransfer): void
    {
        $templateTransfer->imports->uasort($this->sortNamespaces(...));
        $templateTransfer->metaConstants->natsort();

        if ($templateTransfer->metaInitiators->count() > 0) {
            $templateTransfer->metaInitiators->natsort();
        }

        if ($templateTransfer->metaTransformers->count() > 0) {
            $templateTransfer->metaTransformers->natsort();
        }

        $this->sortMetaAttributes($templateTransfer);
    }

    private function sortMetaAttributes(TemplateTransfer $templateTransfer): void
    {
        foreach ($templateTransfer->metaAttributes as &$metaAttributes) {
            natsort($metaAttributes);
        }
        unset($metaAttributes);
    }

    private function sortNamespaces(string $a, string $b): int
    {
        return strcasecmp(
            str_replace(search: '\\', replace: '', subject: $a),
            str_replace(search: '\\', replace: '', subject: $b),
        );
    }
}
