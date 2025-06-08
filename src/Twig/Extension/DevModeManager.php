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

namespace Markocupic\ContaoThemeCaribbeanBlue\Twig\Extension;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DevModeManager extends AbstractExtension
{
    public function __construct(
        #[Autowire(param: 'kernel.debug')]
        private bool $debugMode,
    ) {
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('is_debug_mode', [$this, 'isDebugMode']),
        ];
    }

    public function isDebugMode(): bool
    {
        return $this->debugMode;
    }
}
