<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\Twig\Extension;

use Glory\Bundle\AdminBundle\Variable\Admin;

/**
 * Description of Group
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class AdminExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{

    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function getGlobals()
    {
        return array(
            'admin' => $this->admin,
        );
    }

    public function getName()
    {
        return 'glory_admin.admin';
    }

}
