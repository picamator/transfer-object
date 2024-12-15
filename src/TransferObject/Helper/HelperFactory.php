<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper;

use Picamator\TransferObject\Config\ConfigFacade;
use Picamator\TransferObject\Config\ConfigFacadeInterface;
use Picamator\TransferObject\Generator\GeneratorFacade;
use Picamator\TransferObject\Generator\GeneratorFacadeInterface;
use Picamator\TransferObject\Helper\DefinitionGenerator\DefinitionGenerator;
use Picamator\TransferObject\Helper\DefinitionGenerator\DefinitionGeneratorInterface;
use Picamator\TransferObject\Helper\TransferGenerator\TransferGenerator;
use Picamator\TransferObject\Helper\TransferGenerator\TransferGeneratorInterface;

readonly class HelperFactory
{
   public function createTransferGenerator(): TransferGeneratorInterface
   {
       return new TransferGenerator(
           $this->createConfigFacade(),
           $this->createGeneratorFacade(),
       );
   }

   public function createDefinitionGenerator(): DefinitionGeneratorInterface
   {
       return new DefinitionGenerator();
   }

   protected function createGeneratorFacade(): GeneratorFacadeInterface
   {
       return new GeneratorFacade();
   }

   protected function createConfigFacade(): ConfigFacadeInterface
   {
       return new ConfigFacade();
   }
}
