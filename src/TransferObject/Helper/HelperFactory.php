<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper;

use Picamator\TransferObject\Helper\Definition\DefinitionGenerator;
use Picamator\TransferObject\Helper\Definition\DefinitionGeneratorInterface;
use Picamator\TransferObject\Helper\Filesystem\HelperFilesystem;
use Picamator\TransferObject\Helper\Filesystem\HelperFilesystemInterface;
use Picamator\TransferObject\Helper\Reader\HelperReader;
use Picamator\TransferObject\Helper\Reader\HelperReaderInterface;
use Picamator\TransferObject\Helper\Render\HelperRender;
use Picamator\TransferObject\Helper\Render\HelperRenderInterface;
use Symfony\Component\Filesystem\Filesystem;

readonly class HelperFactory
{
   public function createDefinitionGenerator(): DefinitionGeneratorInterface
   {
       return new DefinitionGenerator(
           $this->createHelperReader(),
           $this->createHelperRender(),
           $this->createHelperFilesystem(),
       );
   }

   private function createHelperFilesystem(): HelperFilesystemInterface
   {
       return new HelperFilesystem($this->createFilesystem());
   }

   private function createFilesystem(): Filesystem
   {
       return new Filesystem();
   }

   protected function createHelperRender(): HelperRenderInterface
   {
       return new HelperRender();
   }

   protected function createHelperReader(): HelperReaderInterface
   {
       return new HelperReader();
   }
}
