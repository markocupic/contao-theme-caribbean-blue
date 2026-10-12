<?php

declare(strict_types=1);

use Contao\EasyCodingStandard\Set\SetList;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return ECSConfig::configure()
    ->withSets([
        SetList::CONTAO,
        \Markocupic\EasyCodingStandard\Set\SetList::MARKOCUPIC,
    ])
    ->withPaths([
        __DIR__ . '/../../src',
    ])
    ->withSkip([
        \Contao\EasyCodingStandard\Fixer\CommentLengthFixer::class          => ['*.php'],
        \PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer::class  => [
            '*/DependencyInjection/Configuration.php',
        ],
    ])
    ->withRootFiles()
    ->withParallel()
    ->withSpacing(Option::INDENTATION_SPACES, "\n")
    ->withConfiguredRule(HeaderCommentFixer::class, [
        'header' => "This file is part of Contao Theme Caribbean Blue.\n\n(c) Marko Cupic <m.cupic@gmx.ch>\n@license MIT\nFor the full copyright and license information,\nplease view the LICENSE file that was distributed with this source code.\n@link https://github.com/markocupic/contao-theme-caribbean-blue",
    ])
    ->withCache(sys_get_temp_dir() . '/ecs/markocupic/contao-schuldienste-theme');
