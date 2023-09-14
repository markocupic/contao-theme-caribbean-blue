<?php

declare(strict_types=1);

namespace Markocupic\ContaoThemeCaribbeanBlue;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarkocupicContaoThemeCaribbeanBlue extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
