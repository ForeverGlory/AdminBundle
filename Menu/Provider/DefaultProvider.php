<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\Menu\Provider;

use Knp\Menu\Provider\MenuProviderInterface;
use Glory\Bundle\MenuBundle\Model\MenuManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Glory\Bundle\MenuBundle\Model\MenuInterface;

/**
 * MenuProvider, get menu from database
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class DefaultProvider implements MenuProviderInterface
{

    /**
     * @var MenuManager
     */
    protected $menuManager;
    protected $menus = array();

    /**
     * 
     * @param MenuManager $menuManager
     */
    public function __construct(MenuManager $menuManager, UrlGeneratorInterface $router)
    {
        $this->menuManager = $menuManager;

        $navigation = $this->menuManager->createMenu();
        $navigation->setName('admin_navigation');
        $navigation->setLabel('Admin Navigation');
        $navigation->setAttribute('template', 'GloryAdminBundle:Menu:navigation.html.twig');

        $sidebar = $this->menuManager->createMenu();
        $sidebar->setName('admin_sidebar');
        $sidebar->setLabel('Admin Sidebar');
        $sidebar->setAttribute('template', 'GloryAdminBundle:Menu:sidebar.html.twig');
        $dashboard = $this->menuManager->createMenu();
        $dashboard->setName('dashboard');
        $dashboard->setLabel('Dashboard');
        $dashboard->setRoute('glory_admin');
        $dashboard->setUri($router->generate('glory_admin'));
        $dashboard->setAttribute('icon', 'fa fa-dashboard');
        $sidebar->addChild($dashboard);

        $this->menus = array(
            'admin_navigation' => $navigation,
            'admin_sidebar' => $sidebar
        );
    }

    /**
     * Retrieves a menu by its name
     *
     * @param string $name
     * @param array $options
     * @return MenuInterface
     */
    public function get($name, array $options = array())
    {
        return $this->menus[$name];
    }

    /**
     * Checks whether a menu exists in this provider
     * 
     * @param string $name
     * @param array $options
     * @return bool
     */
    public function has($name, array $options = array())
    {
        return array_key_exists($name, $this->menus);
    }

}
