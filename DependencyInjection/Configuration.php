<?php

namespace Ephp\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ephp_blog');

        $rootNode
                ->children()
                    ->scalarNode('post_class')->defaultValue('Ephp\BlogBundle\Entity\Post')->cannotBeEmpty()->end()
                ->end()
        ;
        return $treeBuilder;

        return $treeBuilder;
    }
}
