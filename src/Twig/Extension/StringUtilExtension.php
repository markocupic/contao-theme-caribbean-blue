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

use Contao\StringUtil;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class StringUtilExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('string_util_revert_input_encoding', [$this, 'revertInputEncoding']),
        ];
    }

    public function revertInputEncoding(string $value = ''): string
    {
        return StringUtil::revertInputEncoding($value);
    }
}
