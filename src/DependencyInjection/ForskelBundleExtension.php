<?php

/**
 * This file is part of the siemendev/forskel package.
 *
 * (c) Patrick Siemen <post@patrick-siemen.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace siemendev\ForskelBundle\DependencyInjection;

use siemendev\ForskelBundle\Controller\ForskelController;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class ForskelBundleExtension
 *
 * @package siemendev\ForskelBundle\DependencyInjection
 */
class ForskelBundleExtension extends Extension
{
    /**
     * Extension loader
     *
     * @param  array            $mergedConfig
     * @param  ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');

        $configuration = $this->getConfiguration($mergedConfig, $container);
        $config = $this->processConfiguration($configuration, $mergedConfig);

        $container->setParameter('forskel.template_root', (!empty($config['template_root']) ? $config['template_root'] : ''));
    }

    public function getAlias()
    {
        return 'forskel';
    }
}
