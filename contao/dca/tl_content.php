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

use Contao\DataContainer;
use Contao\ArrayUtil;

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
