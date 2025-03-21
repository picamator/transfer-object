<?php

declare(strict_types=1);

use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\TemplateHelper;

$templateTransfer ??= TemplateHelper::getDefaultTemplateTransfer();
$helper = new TemplateHelper($templateTransfer);

echo <<<TEMPLATE
<?php

declare(strict_types=1);

namespace $templateTransfer->classNamespace;

{$helper->renderKeyValue($templateTransfer->imports, 'use :value;')}

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class $templateTransfer->className extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = {$templateTransfer->properties->count()};

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
    public {$helper->getNullable($property)}{$templateTransfer->properties[$property]} \$$property {
        get => \$this->get{$helper->getRequired($property)}Data(self::{$constant}_DATA_INDEX);
        set => \$this->setData(self::{$constant}_DATA_INDEX, \$value);
    }

TEMPLATE;
    $i++;
} ?>
}
