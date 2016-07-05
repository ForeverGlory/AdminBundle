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
 * Description of SettingInstall
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class SettingInstall extends ContainerAwareMission
{

    public function isValid()
    {
        return $this->getManager()->get('site') ? false : true;
    }

    public function execute()
    {
        $manager = $this->getManager();
        $manager->save('site', ['title' => '', 'logo' => '']);
    }

    private function getManager()
    {
        return $this->getContainer()->get('glory_setting.manager');
    }

}
