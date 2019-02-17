<?php
namespace siemendev\ForskelBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('forskel');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('template_root')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}