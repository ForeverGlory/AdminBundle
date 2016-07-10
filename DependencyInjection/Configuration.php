<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('glory_admin');

        $rootNode->children()
                    ->scalarNode('role')->defaultValue('ROLE_ADMIN')->end()
                ->end();

        $this->addNavigationConfiguration($rootNode);
        $this->addSidebarConfiguration($rootNode);
        $this->addDashboardConfiguration($rootNode);

        return $treeBuilder;
    }

    protected function addNavigationConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('navigation')
                ->prototype('scalar')
                ->end()
            ->end();
    }

    protected function addSidebarConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('sidebar')
                ->useAttributeAsKey('name')
                ->prototype('array')
                    ->children()
                        ->scalarNode('title')->end()
                        ->scalarNode('icon')->defaultValue('fa fa-list')->end()
                        ->scalarNode('route')->end()
                        ->arrayNode('parameters')->end()
                        ->scalarNode('path')->end()
                        ->scalarNode('target')->defaultValue('')->end()
                        ->scalarNode('children')->end()
                    ->end()
                ->end()
            ->end();
    }

    protected function addDashboardConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('dashboard')
                ->prototype('array')
                    ->children()
                        ->scalarNode('include')->end()
                        ->scalarNode('controller')->end()
                        ->scalarNode('block')->end()
                    ->end()
                ->end()
            ->end();
    }

}
