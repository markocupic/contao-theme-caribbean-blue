<?php

declare(strict_types=1);

/*
 * This file is part of Contao Theme Caribbean Blue.
 *
 * (c) Marko Cupic <m.cupic@gmx.ch>
 * @license MIT
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/markocupic/contao-theme-caribbean-blue
 */

namespace Markocupic\ContaoThemeCaribbeanBlue\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Markocupic\ContaoThemeCaribbeanBlue\Controller\ContentElement\SplitHeroController;

/**
 * Show image thumbnails and allow image files only
 * in the file picker of the split hero element.
 */
#[AsCallback(table: 'tl_content', target: 'fields.multiSRC.load')]
class SplitHeroMultiSrcListener
{
    public function __construct(
        private readonly array $validExtensions,
    ) {
    }

    public function __invoke(mixed $value, DataContainer $dc): mixed
    {
        if (SplitHeroController::TYPE === ($dc->getCurrentRecord()['type'] ?? null)) {
            $GLOBALS['TL_DCA']['tl_content']['fields']['multiSRC']['eval']['isGallery'] = true;
            $GLOBALS['TL_DCA']['tl_content']['fields']['multiSRC']['eval']['extensions'] = implode(',', $this->validExtensions);
        }

        return $value;
    }
}
