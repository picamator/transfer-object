<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper;

use Picamator\TransferObject\Transfer\Generated\HelperTransfer;

readonly class HelperFacade implements HelperFacadeInterface
{
    public function generateDefinitions(HelperTransfer $helperTransfer): int
    {
        return new HelperFactory()
            ->createDefinitionGenerator()
            ->generateDefinitions($helperTransfer);
    }
}
