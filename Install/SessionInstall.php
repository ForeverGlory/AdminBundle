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
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;

/**
 * Description of SessionInstall
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class SessionInstall extends ContainerAwareMission
{

    public function execute()
    {
        $sessionHandler = $this->getContainer()->get('session.handler');
        if ($sessionHandler instanceof PdoSessionHandler) {
            try {
                $sessionHandler->createTable();
            } catch (\Exception $exc) {
                
            }
        }
    }

    public function getPriority()
    {
        return 1;
    }

}
