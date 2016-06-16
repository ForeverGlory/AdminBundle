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

/**
 * Description of UserInstall
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class UserInstall extends ContainerAwareMission
{

    public function isValid()
    {
        return array_key_exists('GloryUserBundle', $this->getContainer()->getParameter('kernel.bundles'));
    }

    public function execute()
    {
        $this->generateMenu();
    }

    private function generateMenu()
    {
        $menuManager = $this->getExecutor()->getContainer()->get('glory_menu.menu_manager');

        $sidebar = $menuManager->findMenu(['name' => 'admin_sidebar']);

        $user = $menuManager->createMenu();
        $user->setName('用户');
        $user->setIcon('fa fa-user');
        $user->setWeight(2);
        $user->setParent($sidebar);
        $menuManager->updateMenu($user);

        $item = $menuManager->createMenu();
        $item->setName('用户管理');
        $item->setIcon('fa fa-user');
        $item->setRoute('glory_user_manage');
        $item->setParent($user);
        $menuManager->updateMenu($item);

        $item = $menuManager->createMenu();
        $item->setName('分组管理');
        $item->setIcon('fa fa-group');
        $item->setRoute('glory_user_group');
        $item->setParent($user);
        $menuManager->updateMenu($item);
    }

}
