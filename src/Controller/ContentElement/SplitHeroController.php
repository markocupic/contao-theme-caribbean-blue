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

namespace Markocupic\ContaoThemeCaribbeanBlue\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Filesystem\FilesystemItem;
use Contao\CoreBundle\Filesystem\FilesystemUtil;
use Contao\CoreBundle\Filesystem\VirtualFilesystem;
use Contao\CoreBundle\Image\Studio\Figure;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'media')]
class SplitHeroController extends AbstractContentElementController
{
    public const TYPE = 'split_hero';

    public const TITLE_TAGS = ['h1', 'h2', 'h3'];

    public const BUTTON_CLASSES = [
        'btn btn-primary',
        'btn btn-outline-primary',
        'btn btn-dark',
        'btn btn-outline-dark',
        'btn btn-secondary',
        'btn btn-light',
        'btn btn-link',
    ];

    public function __construct(
        private readonly VirtualFilesystem $filesStorage,
        private readonly Studio $studio,
        private readonly InsertTagParser $insertTagParser,
        private readonly array $validExtensions,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $titleTag = \in_array($model->splitHeroTitleTag, self::TITLE_TAGS, true) ? $model->splitHeroTitleTag : 'h1';

        $template->set('eyebrow', trim((string) $model->splitHeroEyebrow));
        $template->set('title', trim((string) $model->splitHeroTitle));
        $template->set('title_tag', $titleTag);
        $template->set('teaser', trim((string) $model->splitHeroTeaser));
        $template->set('buttons', $this->getButtons($model));
        $template->set('images', $this->getImages($model));
        $template->set('autoplay_delay', max(0, (int) $model->splitHeroAutoplayDelay));

        return $template->getResponse();
    }

    /**
     * @return array<int, array{label: string, href: string, class: string, new_window: bool}>
     */
    private function getButtons(ContentModel $model): array
    {
        $buttons = [];

        foreach (StringUtil::deserialize($model->splitHeroButtons, true) as $row) {
            $label = trim((string) ($row['label'] ?? ''));
            $href = trim((string) ($row['href'] ?? ''));

            if ('' === $label || '' === $href) {
                continue;
            }

            $cssClass = (string) ($row['cssClass'] ?? '');

            $buttons[] = [
                'label' => $label,
                'href' => $this->insertTagParser->replaceInline($href),
                'class' => \in_array($cssClass, self::BUTTON_CLASSES, true) ? $cssClass : 'btn btn-primary',
                'new_window' => (bool) ($row['target'] ?? false),
            ];
        }

        return $buttons;
    }

    /**
     * @return array<int, Figure>
     */
    private function getImages(ContentModel $model): array
    {
        if (empty($model->multiSRC)) {
            return [];
        }

        $filesystemItems = FilesystemUtil::listContentsFromSerialized($this->filesStorage, $model->multiSRC)
            ->filter(fn ($item) => \in_array($item->getExtension(true), $this->validExtensions, true))
        ;

        $figureBuilder = $this->studio
            ->createFigureBuilder()
            ->setSize($model->size)
        ;

        return array_values(array_filter(array_map(
            fn (FilesystemItem $filesystemItem): Figure|null => $figureBuilder
                ->fromStorage($this->filesStorage, $filesystemItem->getPath())
                ->buildIfResourceExists(),
            iterator_to_array($filesystemItems),
        )));
    }
}
