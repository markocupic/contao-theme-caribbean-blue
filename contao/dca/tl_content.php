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

use Contao\DataContainer;
use Contao\ArrayUtil;
use Markocupic\ContaoThemeCaribbeanBlue\Controller\ContentElement\SplitHeroController;

// Selectors
// Because overwriteMeta is a nested tl_content.subpalette,
// tl_content.ceTeamMemberAddImage has to be injected before tl_content.subpalette
ArrayUtil::arrayInsert(
    $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'],
    (int)array_search('addImage', $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__']) + 1,
    'ceTeamMemberAddImage',
);

// Palettes
$GLOBALS['TL_DCA']['tl_content']['palettes']['team_member'] = '
{type_legend},type,headline;
{personal_legend},ceTeamMemberFirstname,ceTeamMemberLastname,ceTeamMemberRoles,ceTeamMemberWorkingTime,ceTeamMemberPhone,ceTeamMemberEmail;
{image_legend},ceTeamMemberAddImage;
{template_legend:hide},customTpl;
{protected_legend:hide},protected;
{expert_legend:hide},cssID;
{invisible_legend:hide},invisible,start,stop
';

// Palettes
$GLOBALS['TL_DCA']['tl_content']['palettes']['marquee_text'] = '
{type_legend},type,headline;
{text_legend},marqueeText;
{template_legend:hide},customTpl;
{protected_legend:hide},protected;
{expert_legend:hide},cssID;
{invisible_legend:hide},invisible,start,stop
';

$GLOBALS['TL_DCA']['tl_content']['palettes']['blockquote'] = '
{type_legend},type,headline;
{text_legend},blockquoteText,blockquoteFooterText,blockquoteAlignment;
{template_legend:hide},customTpl;
{protected_legend:hide},protected;
{expert_legend:hide},cssID;
{invisible_legend:hide},invisible,start,stop
';

$GLOBALS['TL_DCA']['tl_content']['palettes']['split_hero'] = '
{type_legend},type;
{split_hero_text_legend},splitHeroEyebrow,splitHeroTitle,splitHeroTitleTag,splitHeroTeaser;
{split_hero_buttons_legend},splitHeroButtons;
{split_hero_images_legend},multiSRC,size,splitHeroAutoplayDelay;
{template_legend:hide},customTpl;
{protected_legend:hide},protected;
{expert_legend:hide},cssID;
{invisible_legend:hide},invisible,start,stop
';

// Subpalettes
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['ceTeamMemberAddImage'] = 'singleSRC,fullsize,size,overwriteMeta';

// Fields
$GLOBALS['TL_DCA']['tl_content']['fields']['ceTeamMemberAddImage'] = $GLOBALS['TL_DCA']['tl_content']['fields']['addImage'];

$GLOBALS['TL_DCA']['tl_content']['fields']['ceTeamMemberFirstname'] = [
    'search'    => true,
    'sorting'   => true,
    'flag'      => DataContainer::SORT_INITIAL_LETTER_BOTH,
    'inputType' => 'text',
    'eval'      => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['ceTeamMemberLastname'] = [
    'search'    => true,
    'sorting'   => true,
    'flag'      => DataContainer::SORT_INITIAL_LETTER_BOTH,
    'inputType' => 'text',
    'eval'      => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['ceTeamMemberPhone'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 64, 'rgxp' => 'phone', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(64) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['ceTeamMemberEmail'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 255, 'rgxp' => 'email', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['ceTeamMemberRoles'] = [
    'inputType' => 'listWizard',
    'eval'      => ['tl_class' => 'clr'],
    'sql'       => ['type' => 'blob', 'notnull' => false],
];

$GLOBALS['TL_DCA']['tl_content']['fields']['ceTeamMemberWorkingTime'] = [
    'inputType' => 'listWizard',
    'eval'      => ['tl_class' => 'clr'],
    'sql'       => ['type' => 'blob', 'notnull' => false],
];

// Marquee Text
$GLOBALS['TL_DCA']['tl_content']['fields']['marqueeText'] = [
    'search'    => true,
    'inputType' => 'textarea',
    'eval'      => ['mandatory' => true, 'basicEntities' => false],
    'sql'       => "mediumtext NULL",
];

// Blockquote
$GLOBALS['TL_DCA']['tl_content']['fields']['blockquoteText'] = [
    'search'      => true,
    'inputType'   => 'textarea',
    'eval'        => ['mandatory' => true, 'basicEntities' => true],
    'explanation' => 'insertTags',
    'sql'         => "mediumtext NULL",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['blockquoteFooterText'] = [
    'search'      => true,
    'inputType'   => 'textarea',
    'eval'        => ['mandatory' => true, 'basicEntities' => true],
    'explanation' => 'insertTags',
    'sql'         => "mediumtext NULL",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['blockquoteAlignment'] = [
    'search'    => true,
    'sorting'   => true,
    'filter'    => true,
    'inputType' => 'select',
    'options'   => ['text-start', 'text-center', 'text-end'],
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default 'text-center'",
];

// Split hero
$GLOBALS['TL_DCA']['tl_content']['fields']['splitHeroEyebrow'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['maxlength' => 255, 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['splitHeroTitle'] = [
    'search'    => true,
    'inputType' => 'text',
    'eval'      => ['mandatory' => true, 'maxlength' => 255, 'decodeEntities' => true, 'tl_class' => 'clr w50'],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['splitHeroTitleTag'] = [
    'inputType' => 'select',
    'options'   => SplitHeroController::TITLE_TAGS,
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(8) NOT NULL default 'h1'",
];

$GLOBALS['TL_DCA']['tl_content']['fields']['splitHeroTeaser'] = [
    'search'    => true,
    'inputType' => 'textarea',
    'eval'      => ['decodeEntities' => true, 'tl_class' => 'clr'],
    'sql'       => 'text NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['splitHeroButtons'] = [
    'inputType' => 'rowWizard',
    'fields'    => [
        'label'    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['splitHeroButtonLabel'],
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 64, 'decodeEntities' => true],
        ],
        'href'     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['splitHeroButtonHref'],
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 2048],
        ],
        'cssClass' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['splitHeroButtonClass'],
            'inputType' => 'select',
            'options'   => SplitHeroController::BUTTON_CLASSES,
            'reference' => &$GLOBALS['TL_LANG']['tl_content']['splitHeroButtonClassOptions'],
        ],
        'target'   => [
            'label'     => &$GLOBALS['TL_LANG']['tl_content']['splitHeroButtonTarget'],
            'inputType' => 'checkbox',
        ],
    ],
    'eval'      => ['tl_class' => 'clr', 'actions' => ['copy', 'delete'], 'max' => 4],
    'sql'       => 'blob NULL',
];

$GLOBALS['TL_DCA']['tl_content']['fields']['splitHeroAutoplayDelay'] = [
    'inputType' => 'text',
    'eval'      => ['rgxp' => 'natural', 'maxlength' => 6, 'tl_class' => 'w50'],
    'sql'       => "int(10) unsigned NOT NULL default 6000",
];
