<?php

declare(strict_types = 1);

use Picamator\TransferObject\Generated\TemplateTransfer;

$templateTransfer ??= new TemplateTransfer();
?>
<?php echo "<?php declare(strict_types = 1);\n" ?>

namespace <?php echo $templateTransfer->classNamespace ?>;

<?php foreach ($templateTransfer->imports as $import): ?>
use <?php echo $import ?>;
<?php endforeach?>

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class <?php echo $templateTransfer->className ?> extends AbstractTransfer
{
    protected const int META_DATA_SIZE = <?php echo $templateTransfer->propertiesCount ?>;

    protected const array META_DATA = [
<?php foreach ($templateTransfer->metaConstants as $constant => $property): ?>
        self::<?php echo $constant ?> => self::<?php echo $constant ?>_DATA_NAME,
<?php endforeach?>
    ];

<?php $i = 0; ?>
<?php foreach ($templateTransfer->metaConstants as $constant => $property): ?>
    // <?php echo $property . PHP_EOL ?>
<?php echo !isset($templateTransfer->attributes[$property]) ? '' : sprintf('    #[%s]', $templateTransfer->attributes[$property]) . PHP_EOL ?>
    public const string <?php echo $constant ?> = '<?php echo $property ?>';
    protected const string <?php echo $constant ?>_DATA_NAME = '<?php echo $constant ?>';
    protected const int <?php echo $constant ?>_DATA_INDEX = <?php echo $i ?>;<?php $i++ ?>

<?php echo PHP_EOL ?>
<?php echo !isset($templateTransfer->dockBlocks[$property]) ? '' : '    /** @var ' . $templateTransfer->dockBlocks[$property] . ' */' . PHP_EOL ?>
    public <?php echo isset($templateTransfer->defaultValues[$property]) ? '' : '?' ?><?php echo $templateTransfer->properties[$property] ?> $<?php echo $property ?> {
        get => $this->_data[self::<?php echo $constant ?>_DATA_INDEX]<?php echo isset($templateTransfer->defaultValues[$property]) ? ' ?? ' . $templateTransfer->defaultValues[$property] : '' ?>;
        set => $this->_data[self::<?php echo $constant ?>_DATA_INDEX] = $value;
    }
<?php echo $i < $templateTransfer->propertiesCount ? PHP_EOL : '' ?>
<?php endforeach?>
}
