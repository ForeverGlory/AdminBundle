<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * check TwigEngine
 * 
 * 重写Twig引擎，扩展后台页面判断
 * @see \Glory\Bundle\AdminBundle\Twig\Templating\TwigEngine
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class TwigEnginePass implements CompilerPassInterface
{

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $container->setDefinition(
                'glory_admin.twig_engine', $container->getDefinition('templating.engine.twig')
        );
        $container->setDefinition(
                        'templating.engine.twig', new Definition('Glory\\Bundle\\AdminBundle\\Twig\\Templating\\TwigEngine', [
                    new Reference('twig'), new Reference('templating.name_parser'), new Reference('templating.locator')
                ]))
                ->addMethodCall('setEngine', [new Reference('glory_admin.twig_engine')])
                ->addMethodCall('setAdmin', [new Reference('glory_admin.admin')])
                ->addMethodCall('setRequest',[new Reference('request_stack')])
        ;
    }

}
