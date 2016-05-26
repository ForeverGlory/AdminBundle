<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of SecurityController
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class SecurityController extends Controller
{

    public function logoutAction(Request $request)
    {
        $util = $this->get('glory_admin.util.logout_url_generator');
        return $this->redirect($util->getLogoutPath($request));
    }

}
