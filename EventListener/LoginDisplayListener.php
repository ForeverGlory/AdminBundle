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
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Glory\Bundle\AdminBundle\Variable\Admin;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * Description of LoginDisplayListener
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class LoginDisplayListener implements EventSubscriberInterface
{

    protected $admin;
    protected $router;

    public function __construct(Admin $admin, RouterInterface $router)
    {
        $this->admin = $admin;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => array('onKernelException', 8)
        );
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        if ($exception instanceof AccessDeniedException && $this->admin->inAdmin() && $event->getRequestType() == HttpKernelInterface::MASTER_REQUEST) {
            $response = new RedirectResponse($this->router->generate('glory_admin_login'));
            $event->setResponse($response);
        }
    }

}
