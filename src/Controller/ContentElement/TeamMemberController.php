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

namespace Markocupic\ContaoThemeCaribbeanBlue\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\CoreBundle\Filesystem\FilesystemItem;
use Contao\CoreBundle\Filesystem\FilesystemUtil;
use Contao\CoreBundle\Filesystem\VirtualFilesystem;
use Contao\CoreBundle\Image\Studio\Figure;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'team_content_elements')]
class TeamMemberController extends AbstractContentElementController
{
    public function __construct(
        private readonly VirtualFilesystem $filesStorage,
        private readonly Studio $studio,
        private readonly array $validExtensions,
    ) {
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        if ($model->ceTeamMemberAddImage) {
            // Find all images (see #5911)
            $filesystemItems = FilesystemUtil::listContentsFromSerialized($this->filesStorage, $model->singleSRC)
                ->filter(fn ($item) => \in_array($item->getExtension(true), $this->validExtensions, true))
            ;

            // Compile list of images
            $figureBuilder = $this->studio
                ->createFigureBuilder()
                ->setSize($model->size)
                ->setLightboxGroupIdentifier('lb'.$model->id)
                ->enableLightbox($model->fullsize)
                ->setOverwriteMetadata($model->getOverwriteMetadata())
            ;

            $imageList = array_map(
                fn (FilesystemItem $filesystemItem): Figure => $figureBuilder
                    ->fromStorage($this->filesStorage, $filesystemItem->getPath())
                    ->build(),
                iterator_to_array($filesystemItems)
            );

            if ($imageList) {
                $template->set('images', $imageList);
                $template->set('has_image', true);
            }
        }

        $template->set('firstname', $model->ceTeamMemberFirstname);
        $template->set('lastname', $model->ceTeamMemberLastname);
        $template->set('phone', $model->ceTeamMemberPhone);
        $template->set('email', $model->ceTeamMemberEmail);

        $arrRoles = array_filter(StringUtil::deserialize($model->ceTeamMemberRoles, true));
        $template->set('roles', !empty($arrRoles) ? $arrRoles : null);

        $arrWorkingTime = array_filter(StringUtil::deserialize($model->ceTeamMemberWorkingTime, true));
        $template->set('working_time', !empty($arrWorkingTime) ? $arrWorkingTime : null);

        return $template->getResponse();
    }
}
