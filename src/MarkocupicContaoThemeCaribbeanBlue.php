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

namespace Markocupic\ContaoThemeCaribbeanBlue;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarkocupicContaoThemeCaribbeanBlue extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
