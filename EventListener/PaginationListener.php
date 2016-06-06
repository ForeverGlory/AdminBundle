<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Glory\Bundle\AdminBundle\Variable\Admin;
use Knp\Component\Pager\Event\AfterEvent;

/**
 * Description of PaginationListener
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class PaginationListener implements EventSubscriberInterface
{

    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function onPagerAfter(AfterEvent $event)
    {
        if ($this->admin->inAdmin()) {
            $pagination = $event->getPaginationView();
            $pagination->setTemplate('GloryAdminBundle:Pagination:pagination.html.twig');
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            'knp_pager.after' => array('onPagerAfter', 1),
        );
    }

}
