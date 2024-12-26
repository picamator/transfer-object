<?php

declare(strict_types=1);

use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\TemplateHelper;

$templateTransfer ??= new TemplateTransfer();
$helper = new TemplateHelper($templateTransfer);

echo <<<TEMPLATE
<?php

declare(strict_types=1);

namespace $templateTransfer->classNamespace;

{$helper->renderKeyValue($templateTransfer->imports, 'use :value;')}

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class $templateTransfer->className extends AbstractTransfer
{
    protected const int META_DATA_SIZE = $templateTransfer->propertiesCount;

    protected const array META_DATA = [
{$helper->renderKeyValue($templateTransfer->metaConstants, '        self:::key => self:::key_DATA_NAME,')}
    ];

TEMPLATE;

$i = 0;
foreach ($templateTransfer->metaConstants as $constant => $property) {
    echo <<<TEMPLATE

    // $property{$helper->getAttribute($property)}
    public const string $constant = '$property';
    protected const string {$constant}_DATA_NAME = '$constant';
    protected const int {$constant}_DATA_INDEX = $i;
{$helper->getDockBlock($property)}
    public {$helper->getNullable($property)}{$templateTransfer->properties[$property]} \${$property} {
        get => \$this->_data[self::{$constant}_DATA_INDEX]{$helper->getDefault($property)};
        set => \$this->_data[self::{$constant}_DATA_INDEX] = \$value;
    }

TEMPLATE;
    $i++;
} ?>
}
