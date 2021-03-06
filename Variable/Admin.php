<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\Variable;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Glory\Bundle\MenuBundle\Twig\Extension\MenuExtension;

/**
 * Description of Admin
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Admin
{

    protected $container;

    /**
     * @var MenuExtension 
     */
    protected $menuExtension;
    protected $adminPaths = ['^\/admin'];
    protected $inAdmin;
    protected $stylesheets;
    protected $javascripts;
    protected $sidebars;
    protected $navigations;

    public function __construct(ContainerInterface $container, MenuExtension $menuExtension)
    {
        $this->container = $container;
        $this->menuExtension = $menuExtension;
    }

    public function getTitle()
    {
        return 'Admin';
    }

    public function setSidebars($sidebars)
    {
        $this->sidebars = $sidebars;
        return $this;
    }

    public function getSidebars()
    {
        return $this->sidebars;
    }

    public function setNavigations($navigations)
    {
        $this->navigations = $navigations;
        return $this;
    }

    public function getNavigations()
    {
        return $this->navigations;
    }

    public function inAdmin()
    {
        if (!isset($this->inAdmin)) {
            $request = $this->container->get('request');
            $paths = $this->adminPaths;
            foreach ($paths as $path) {
                if (preg_match('/' . $path . '/', $request->getPathInfo())) {
                    $this->inAdmin = true;
                    return true;
                }
            }
            $this->inAdmin = false;
        }
        return $this->inAdmin;
    }

    public function getMenuRender($name)
    {
        return $this->menuExtension->render(sprintf('admin_%s', $name), ['template' => sprintf('GloryAdminBundle:Menu:%s.html.twig', $name)]);
    }

    public function getMenu_Render($name)
    {
        return $this->getMenuRender($name);
    }

}
