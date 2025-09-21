<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Render\Template;

use Picamator\TransferObject\Generated\TemplateTransfer;

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

    {$this->renderProperties($templateTransfer)}
}

TEMPLATE;

        return $content;
    }

    private function renderProperties(TemplateTransfer $templateTransfer): string
    {
        $i = 0;
        $properties = [];

        /**
         * @var string $constant
         * @var string $property
         */
        foreach ($templateTransfer->metaConstants as $constant => $property) {
            $properties[] = <<<TEMPLATE

    // $property{$this->helper->renderAttribute($property)}
    public const string $constant = '$property';
    protected const int {$constant}_INDEX = $i;
{$this->helper->renderDockBlock($property)}
    public{$this->helper->renderPropertyDeclaration($property)} \$$property {
        get => \$this->getData(self::{$constant}_INDEX);
        set => \$this->setData(self::{$constant}_INDEX, \$value);
    }
TEMPLATE;
            $i++;
        }

        return trim(implode(PHP_EOL, $properties));
    }
}
