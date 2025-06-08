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

use Contao\CoreBundle\Routing\ResponseContext\Csp\CspHandler;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContextAccessor;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\Asset\Packages;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class FrontendAssetsSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly Packages $packages,
        private readonly ResponseContextAccessor $responseContextAccessor,
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

            $GLOBALS['TL_JAVASCRIPT'][] = $this->packages->getUrl('js/theme/theme.js', 'markocupic_contao_theme_caribbean_blue');

            // Bootstrap
            $GLOBALS['TL_CSS'][] = $this->packages->getUrl('styles/frontend.css', 'markocupic_contao_theme_caribbean_blue');
            $GLOBALS['TL_BODY'][] = '<script defer src="'.$this->packages->getUrl('bootstrap/dist/js/bootstrap.bundle.min.js', 'markocupic_contao_theme_caribbean_blue').'"></script>';

            // Headroom
            $GLOBALS['TL_BODY'][] = '<script defer src="'.$this->packages->getUrl('headroom.js', 'markocupic_contao_theme_caribbean_blue').'"></script>';

            // Viewport
            $GLOBALS['TL_HEAD'][] = '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';

            // Favicon
            $GLOBALS['TL_HEAD'][] = $this->getFaviconMarkup();

            // Font Awesome 6 Pro
            $this->addFontAwesome();
        }
    }

    private function getFaviconMarkup(): string
    {
        return '
      <link rel="apple-touch-icon" sizes="57x57" href="'.$this->packages->getUrl('favicon/apple-icon-57x57.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="apple-touch-icon" sizes="60x60" href="'.$this->packages->getUrl('favicon/apple-icon-60x60.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="apple-touch-icon" sizes="72x72" href="'.$this->packages->getUrl('favicon/apple-icon-72x72.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="apple-touch-icon" sizes="76x76" href="'.$this->packages->getUrl('favicon/apple-icon-76x76.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="apple-touch-icon" sizes="114x114" href="'.$this->packages->getUrl('favicon/apple-icon-114x114.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="apple-touch-icon" sizes="120x120" href="'.$this->packages->getUrl('favicon/apple-icon-120x120.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="apple-touch-icon" sizes="144x144" href="'.$this->packages->getUrl('favicon/apple-icon-144x144.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="apple-touch-icon" sizes="152x152" href="'.$this->packages->getUrl('favicon/apple-icon-152x152.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="apple-touch-icon" sizes="180x180" href="'.$this->packages->getUrl('favicon/apple-icon-180x180.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="icon" type="image/png" sizes="192x192"  href="'.$this->packages->getUrl('favicon/android-icon-192x192.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="icon" type="image/png" sizes="32x32" href="'.$this->packages->getUrl('favicon/favicon-32x32.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="icon" type="image/png" sizes="96x96" href="'.$this->packages->getUrl('favicon/favicon-96x96.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="icon" type="image/png" sizes="16x16" href="'.$this->packages->getUrl('favicon/favicon-16x16.png', 'markocupic_contao_theme_caribbean_blue').'">
      <link rel="manifest" href="'.$this->packages->getUrl('favicon/manifest.json', 'markocupic_contao_theme_caribbean_blue').'">
      <meta name="msapplication-TileColor" content="#ffffff">
      <meta name="msapplication-TileImage" content="'.$this->packages->getUrl('favicon/ms-icon-144x144.png', 'markocupic_contao_theme_caribbean_blue').'">
      <meta name="theme-color" content="#ffffff">
      ';
    }

    private function addFontAwesome(): void
    {
        // Load Font Awesome key from configuration
        // $GLOBALS['TL_BODY'][] = '<script src="https://kit.fontawesome.com/'.$this->fontAwesomeKitKey.'.js" crossorigin="anonymous"></script>';
        // Due to bandwidth limitations we host fontawesome ourselves
        // @todo: CSP -> https://docs.fontawesome.com/web/dig-deeper/security#:~:text=and%20address%20things.-,Content,-Security%20Policy
        $GLOBALS['TL_BODY'][] = $this->generateScriptTag('assets/contao-component-fontawesome-pro/fontawesome-pro/js/fontawesome.min.js?v=6.7.2', true);
        $GLOBALS['TL_BODY'][] = $this->generateScriptTag('assets/contao-component-fontawesome-pro/fontawesome-pro/js/light.min.js?v=6.7.2', true);
        $GLOBALS['TL_BODY'][] = $this->generateScriptTag('assets/contao-component-fontawesome-pro/fontawesome-pro/js/regular.min.js?v=6.7.2', true);
        $GLOBALS['TL_BODY'][] = $this->generateScriptTag('assets/contao-component-fontawesome-pro/fontawesome-pro/js/solid.min.js?v=6.7.2', true);

        $GLOBALS['TL_CSS'][] = 'assets/contao-component-fontawesome-pro/fontawesome-pro/css/fontawesome.min.css?v=6.7.2';
        $GLOBALS['TL_CSS'][] = 'assets/contao-component-fontawesome-pro/fontawesome-pro/css/light.min.css?v=6.7.2';
        $GLOBALS['TL_CSS'][] = 'assets/contao-component-fontawesome-pro/fontawesome-pro/css/regular.min.css?v=6.7.2';
        $GLOBALS['TL_CSS'][] = 'assets/contao-component-fontawesome-pro/fontawesome-pro/css/solid.min.css?v=6.7.2';
        //$GLOBALS['TL_CSS'][] = 'assets/contao-component-fontawesome-pro/fontawesome-pro/css/svg-with-js.min.css?v=6.7.2';
    }

    private function generateScriptTag(string|null $src = null, $defer = false, $script = '')
    {
        $responseContext = $this->responseContextAccessor->getResponseContext();

        if ($responseContext?->has(CspHandler::class)) {
            $cspHandler = $responseContext->get(CspHandler::class);
        }

        $attrDefer = $defer ? ' defer' : '';

        $nonce = !empty($cspHandler) ? $cspHandler->getNonce('script-src') : '';
        $attrNonce = !empty($nonce) ? sprintf(' nonce="%s"', $nonce) : '';

        if (!empty($src)) {
            $src = '/'.ltrim($src, '/');
        }
        $attrSrc = !empty($src) ? sprintf(' src="%s"', $src) : '';

        return sprintf('<script%s%s%s>%s</script>', $attrDefer, $attrNonce, $attrSrc, $script);
    }

}
