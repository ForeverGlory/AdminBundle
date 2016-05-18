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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class GloryAdminExtension extends Extension
{

    protected $menu = [];

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('glory_admin.role', $config['role']);

        foreach ($config['stylesheets'] as $stylesheet) {
            $this->addStylesheet($container, $stylesheet);
        }
        foreach ($config['javascripts'] as $javascript) {
            $this->addJavascript($container, $javascript);
        }

        foreach ($config['sidebar'] as $name => $sidebar) {
            $this->addSidebar($container, $name, $sidebar);
        }
        foreach ($config['navigation'] as $name => $navigation) {
            $this->addNavigation($container, $name, $navigation);
        }
    }

    public function addStylesheet(ContainerBuilder $container, $stylesheet)
    {
        $container->getDefinition('glory_admin.admin')
                ->addMethodCall('addStylesheet', array($stylesheet));
    }

    public function addJavascript(ContainerBuilder $container, $javascript)
    {
        $container->getDefinition('glory_admin.admin')
                ->addMethodCall('addJavascript', array($javascript));
    }

    public function addSidebar(ContainerBuilder $container, $name, $sidebar = [])
    {
        
    }

    public function addNavigation(ContainerBuilder $container, $name, $navigation = [])
    {
        
    }

}
