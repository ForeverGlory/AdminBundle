<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\Install;

use Glory\Executor\Bundle\ContainerAwareMission;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Glory\Bundle\MenuBundle\Model\MenuManager;
use Glory\Bundle\MenuBundle\Model\MenuInterface;

/**
 * Description of MenuInstall
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class MenuInstall extends ContainerAwareMission
{

    public function getPriority()
    {
        return 255;
    }

    public function isValid()
    {
        $menuManager = $this->getMenuManager();
        $sidebar = $menuManager->findMenu(['name' => 'admin_sidebar']);
        return $sidebar ? false : true;
    }

    public function execute()
    {
        $menuManager = $this->getMenuManager();

        $sidebar = $menuManager->createMenu();
        $sidebar->setName('admin_sidebar');
        $sidebar->setLabel('Admin Sidebar');
        $menuManager->updateMenu($sidebar);

        $dashboard = $menuManager->createMenu();
        $dashboard->setName('dashboard');
        $dashboard->setLabel('Dashboard');
        $dashboard->setRoute('glory_admin_dashboard');
        $dashboard->setIcon('fa fa-dashboard');
        $dashboard->setParent($sidebar);
        $menuManager->updateMenu($dashboard);

        $menu = $menuManager->createMenu();
        $menu->setName('admin_sidebar_menu');
        $menu->setLabel('菜单');
        $menu->setIcon('fa fa-list');
        $menu->setWeight(1);
        $menu->setParent($sidebar);
        $menuManager->updateMenu($menu);

        $item = $menuManager->createMenu();
        $item->setName('admin_sidebar_menu_admin');
        $item->setName('菜单管理');
        $item->setIcon('fa fa-list');
        $item->setRoute('glory_menu');
        $item->setParent($menu);
        $menuManager->updateMenu($item);
    }

    /**
     * @return MenuManager
     */
    public function getMenuManager()
    {
        return $this->getExecutor()->getContainer()->get('glory_menu.menu_manager');
    }

}
