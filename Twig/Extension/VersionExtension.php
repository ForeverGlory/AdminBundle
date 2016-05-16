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

/**
 * Description of Group
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class VersionExtension extends \Twig_Extension
{

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('admin_version', array($this, 'getVersion')),
        );
    }

    public function getVersion()
    {
        return \Glory\Bundle\AdminBundle\GloryAdminSupport::VERSION;
    }

    public function getName()
    {
        return 'glory_admin.version';
    }

}
