<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper\TemplateHelperInterface;

readonly class Template implements TemplateInterface
{
    public function __construct(private TemplateHelperInterface $helper)
    {
    }

    public function render(TemplateTransfer $templateTransfer): string
    {
        $this->helper->setTemplateTransfer($templateTransfer);

        return <<<TEMPLATE
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
    ];{$this->helper->renderMetaInitiators()}{$this->helper->renderMetaTransformers()}

    {$this->renderProperties($templateTransfer)}
}

TEMPLATE;
    }

    private function renderProperties(TemplateTransfer $templateTransfer): string
    {
        $i = 0;
        $properties = '';

        foreach ($templateTransfer->metaConstants as $property => $constant) {
            $properties .= <<<TEMPLATE

    // $property{$this->helper->renderMetaAttributes($property)}
    public const string {$constant}_PROP = '$property';
    private const int {$constant}_INDEX = $i;
{$this->helper->renderDocBlock($property)}{$this->helper->renderPropertyAttributes($property)}
    public{$this->helper->renderPropertyDeclaration($property)} \$$property {
        get => \$this->getData(self::{$constant}_INDEX);
        set {
            \$this->setData(self::{$constant}_INDEX, \$value);
        }
    }

TEMPLATE;
            $i++;
        }

        return trim($properties);
    }
}
