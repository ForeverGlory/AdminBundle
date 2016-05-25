<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * GloryAdminBundle
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class GloryAdminBundle extends Bundle
{

    public function build(ContainerInterface $container)
    {
        parent::build($container);
    }

}
