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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package siemendev\ForskelBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Configuration tree builder
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('forskel');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('template_root')->end()
            ->end();

        return $treeBuilder;
    }
}
