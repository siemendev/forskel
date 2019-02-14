<?php
namespace siemendev\ForskelBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use siemendev\ForskelBundle\DependencyInjection\ForskelBundleExtension;

class ForskelBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ForskelBundleExtension();
    }
}
