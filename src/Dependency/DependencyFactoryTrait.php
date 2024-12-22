<?php declare(strict_types=1);

namespace Picamator\TransferObject\Dependency;

trait DependencyFactoryTrait
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\DependencyNotFoundTransferException
     */
   protected function getDependency(string $id): mixed
   {
       return new DependencyContainer()->get($id);
   }
}
