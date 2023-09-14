<?php

declare(strict_types=1);

namespace Markocupic\ContaoThemeCaribbeanBlue\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Markocupic\ContaoThemeCaribbeanBlue\MarkocupicContaoThemeCaribbeanBlue;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(MarkocupicContaoThemeCaribbeanBlue::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
