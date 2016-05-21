<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <https://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\AdminBundle\Util;

use Symfony\Bundle\SecurityBundle\Security\FirewallMap;
use Symfony\Component\Security\Http\Logout\LogoutUrlGenerator;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of GetLogout
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class LogoutUrlGenerator extends FirewallMap
{

    protected $map;

    /**
     * @var LogoutUrlGenerator
     */
    protected $logout;

    public function setSecurityLogout(LogoutUrlGenerator $logout)
    {
        $this->logout = $logout;
    }

    public function getLogoutPath(Request $request)
    {
        foreach ($this->map as $contextId => $requestMatcher) {
            if (null === $requestMatcher || $requestMatcher->matches($request)) {
                $key = str_replace('security.firewall.map.context.', '', $contextId, $count);
                if (!$count) {
                    throw new \InvalidArgumentException('Not found ');
                }
                return $this->logout->getLogoutPath($key);
            }
        }
        return '/logout';
    }

}
