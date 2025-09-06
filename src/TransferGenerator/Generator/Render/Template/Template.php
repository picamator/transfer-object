<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

/**
 * phpcs:disable Generic.Files.LineLength
 */
readonly class Template
{
    public function __construct(private TemplateHelperInterface $helper)
    {
    }

    public function __invoke(TemplateTransfer $templateTransfer): string
    {
        $this->helper->setTemplateTransfer($templateTransfer);

        $content = <<<TEMPLATE
<?php

declare(strict_types=1);

namespace $templateTransfer->classNamespace;

{$this->helper->renderImports()}

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see $templateTransfer->definitionPath Definition file path.
 */
final class $templateTransfer->className extends AbstractTransfer
{
    protected const int META_DATA_SIZE = {$templateTransfer->properties->count()};

    protected const array META_DATA = [
{$this->helper->renderMetaData()}
    ];

TEMPLATE;

        $i = 0;
        foreach ($templateTransfer->metaConstants as $constant => $property) {
            $content .= <<<TEMPLATE

    // $property{$this->helper->renderAttribute($property)}
    public const string $constant = '$property';
    protected const string {$constant}_DATA_NAME = '$constant';
    protected const int {$constant}_DATA_INDEX = $i;
{$this->helper->renderDockBlock($property)}
    public{$this->helper->renderProtected($property)} {$this->helper->renderNullable($property)}{$templateTransfer->properties[$property]} \$$property {
        get => \$this->getData(self::{$constant}_DATA_INDEX);
        set => \$this->setData(self::{$constant}_DATA_INDEX, \$value);
    }

TEMPLATE;
            $i++;
        }

        $content .= <<<'TEMPLATE'
}

TEMPLATE;

        return $content;
    }
}
