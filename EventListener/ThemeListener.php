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
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bridge\Twig\DataCollector\TwigDataCollector;

/**
 * Description of ThemeListener
 *
 * service.yml
    glory_admin.event.theme_listener:
        class: Glory\Bundle\AdminBundle\EventListener\ThemeListener
        arguments: [@twig, @glory_admin.admin, @data_collector.twig]
        tags:
            -  { name: kernel.event_subscriber }
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class ThemeListener implements EventSubscriberInterface
{

    protected $twig;
    protected $collector;
    protected $admin;

    public function __construct(\Twig_Environment $twig, TwigDataCollector $collector, Admin $admin)
    {
        $this->twig = $twig;
        $this->collector = $collector;
        $this->admin = $admin;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {

        $response = $event->getResponse();
        $request = $event->getRequest();

        if (!$event->isMasterRequest()) {
            return;
        }
        if ($request->isXmlHttpRequest()) {
            return;
        }

        if ($this->admin->inAdmin()) {
            $templates = $this->collector->getTemplates();
            $response->setContent($this->twig->render('GloryAdminBundle::layout.html.twig'));
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            //KernelEvents::RESPONSE => array('onKernelResponse', 128),
        );
    }

}
