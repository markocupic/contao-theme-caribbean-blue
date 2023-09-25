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

namespace Markocupic\ContaoThemeCaribbeanBlue\EventListener\Contao;

use Contao\ContentDownload;
use Contao\ContentModel;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('replaceInsertTags', priority: 100)]
class ReplaceInsertTagsListener
{

    public function __invoke(string $strTag): bool|string
    {

        // Trim whitespaces
        $strTag = '' !== $strTag ? trim($strTag) : $strTag;

        // Download Link
        // {{download_link::5678-r8er-6erw-wr99::My Download}}
        if (str_contains($strTag, 'download_link')) {
            $elements = explode('::', $strTag);

            if (\is_array($elements) && \count($elements) >= 2) {
                $model = new ContentModel();
                $model->singleSRC = $elements[1];
                $model->type = 'download';

                $contentElement = new ContentDownload($model);
                return $contentElement->generate();
            }
        }

        return false;
    }
}
