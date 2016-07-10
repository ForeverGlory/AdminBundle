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
 * Description of DefaultController
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class DefaultController extends Controller
{

    public function dashboardAction(Request $request)
    {
        $dashboard = $this->getParameter('glory_admin.dashboard');
        return $this->render('GloryAdminBundle:Default:dashboard.html.twig', ['dashboard' => $dashboard]);
    }

}
