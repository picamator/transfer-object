<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper;

use Picamator\TransferObject\Helper\Definition\DefinitionGenerator;
use Picamator\TransferObject\Helper\Definition\DefinitionGeneratorInterface;

readonly class HelperFactory
{
   public function createDefinitionGenerator(): DefinitionGeneratorInterface
   {
       return new DefinitionGenerator();
   }
}
