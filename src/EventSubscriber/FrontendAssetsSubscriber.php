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
            $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/markocupiccontaothemecaribbeanblue/js/theme/theme.js|static';
            $GLOBALS['TL_JAVASCRIPT'][] = '/bundles/markocupiccontaothemecaribbeanblue/js/theme/navbar_navigation.js|static';
            //$GLOBALS['TL_CSS'][] = 'files/themes/theme-caribbean-blue/css/main.css|static';

            // Viewport
            $GLOBALS['TL_HEAD'][] = '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';

            // Favicon
            $GLOBALS['TL_HEAD'][] = $this->getFaviconMarkup();

            // Google web fonts
            $GLOBALS['TL_HEAD'][] = '<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap" rel="stylesheet">';

            // Bootstrap
            $GLOBALS['TL_BODY'][] = '<script defer src="/assets/contao-component-bootstrap/bootstrap/dist/js/bootstrap.bundle.min.js"></script>';

            // Font Awesome
            //$GLOBALS['TL_CSS'][] = '/files/fontawesome-pro-5.5.0-web/css/all.css|static';
            //$GLOBALS['TL_BODY'][] = '<script defer src="/files/fontawesome-pro-5.5.0-web/js/all.js"></script>';
            $GLOBALS['TL_BODY'][] = '<script src="https://kit.fontawesome.com/edd1254fa6.js" crossorigin="anonymous"></script>';
        }
    }

    private function getFaviconMarkup(): string
    {
        return '
      <link rel="apple-touch-icon" sizes="57x57" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="/bundles/markocupiccontaothemecaribbeanblue/favicon/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/favicon-16x16.png">
      <link rel="manifest" href="/bundles/markocupiccontaothemecaribbeanblue/favicon/manifest.json">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="/bundles/markocupiccontaothemecaribbeanblue/favicon/ms-icon-144x144.png">
      <meta name="theme-color" content="#ffffff">
      ';
    }
    
}
