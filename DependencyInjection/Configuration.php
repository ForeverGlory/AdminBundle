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

        $this->addStylesheetsConfiguration($rootNode);
        $this->addJavascriptsConfiguration($rootNode);
        $this->addNavigationConfiguration($rootNode);
        $this->addSidebarConfiguration($rootNode);
        $this->addDashboardConfiguration($rootNode);

        return $treeBuilder;
    }

    protected function addStylesheetsConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('stylesheets')
                ->defaultValue(array(
                    'bundles/gloryadmin/components/bootstrap/dist/css/bootstrap.min.css',
                    'bundles/gloryadmin/components/fontawesome/css/font-awesome.min.css',
                    'bundles/gloryadmin/components/adminlte/dist/css/AdminLTE.min.css',
                    'bundles/gloryadmin/components/adminlte/dist/css/skins/_all-skins.min.css'
                ))
                ->prototype('scalar')
                ->end()
            ->end();
    }

    protected function addJavascriptsConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('javascripts')
                ->defaultValue(array(
                    'bundles/gloryadmin/components/jquery/dist/jquery.min.js',
                    'bundles/gloryadmin/components/bootstrap/dist/js/bootstrap.min.js',
                    'bundles/gloryadmin/components/adminlte/plugins/fastclick/fastclick.min.js',
                    'bundles/gloryadmin/components/adminlte/plugins/slimScroll/jquery.slimscroll.min.js',
                    'bundles/gloryadmin/components/adminlte/dist/js/app.js'
                ))
                ->prototype('scalar')
                ->end()
            ->end();
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
                        ->scalarNode('controller')->end()
                        ->scalarNode('block')->end()
                    ->end()
                ->end()
            ->end();
    }

}
