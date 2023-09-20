<?php

declare(strict_types=1);

/*
 * This file is part of Contao Theme Caribbean Blue.
 *
 * (c) Marko Cupic 2023 <m.cupic@gmx.ch>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-theme-caribbean-blue
 */

namespace Markocupic\ContaoThemeCaribbeanBlue\EventSubscriber;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class FrontendAssetsSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly ScopeMatcher $scopeMatcher,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => 'registerFrontendAssets'];
    }

    public function registerFrontendAssets(RequestEvent $e): void
    {
        $request = $e->getRequest();

        if ($this->scopeMatcher->isFrontendRequest($request)) {
            $GLOBALS['TL_JAVASCRIPT'][] = 'files/themes/theme-caribbean-blue/js/theme.js|static';
            $GLOBALS['TL_JAVASCRIPT'][] = 'files/themes/theme-caribbean-blue/js/navbar_navigation.js|static';
            //$GLOBALS['TL_CSS'][] = 'files/themes/theme-caribbean-blue/css/main.css|static';

            // Bootstrap
            $GLOBALS['TL_BODY'][] = '<script defer src="/assets/contao-component-bootstrap/bootstrap/dist/js/bootstrap.bundle.min.js"></script>';

            // WOW
            $GLOBALS['TL_JAVASCRIPT'][] = 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js';
            $GLOBALS['TL_CSS'][] = 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css';

            // Font Awesome
            $GLOBALS['TL_CSS'][] = '/files/fontawesome-pro-5.5.0-web/css/all.css|static';
            $GLOBALS['TL_BODY'][] = '<script defer src="/files/fontawesome-pro-5.5.0-web/js/all.js"></script>';
        }
    }
}
