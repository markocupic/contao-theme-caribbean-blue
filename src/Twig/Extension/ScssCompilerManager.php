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

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use ScssPhp\ScssPhp\Compiler;

class ScssCompilerManager extends AbstractExtension
{

    public function getFunctions(): array
    {
        return [
            new TwigFunction('scss_to_css', [$this, 'compileScssToCss']),
        ];
    }

    /**
     * Returns the compiled CSS string
     */
    public function compileScssToCss(string $strScss): string
    {

        return (new Compiler())->compileString($strScss)->getCss();
    }
}
