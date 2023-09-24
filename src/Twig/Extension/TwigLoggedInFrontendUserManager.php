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

namespace Markocupic\ContaoThemeCaribbeanBlue\Twig\Extension;

use Contao\CoreBundle\Framework\Adapter;
use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\FrontendUser;
use Contao\MemberModel;
use Symfony\Component\Security\Core\Security;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigLoggedInFrontendUserManager extends AbstractExtension
{
    private Adapter $member;

    public function __construct(
        private readonly ContaoFramework $framework,
        private readonly Security $security,
    ) {
        $this->member = $this->framework->getAdapter(MemberModel::class);
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('has_logged_in_frontend_user', [$this, 'hasLoggedInFrontendUser']),
            new TwigFunction('get_logged_in_frontend_user', [$this, 'getLoggedInFrontendUser']),
        ];
    }

    /**
     * Returns true if a Contao frontend member is logged in.
     *
     * Inside your Twig template:
     * {% if has_logged_in_frontend_user() is sames as true %}Frontend user logged in{% endif %}
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function hasLoggedInFrontendUser(): bool
    {
        return null !== $this->getLoggedInFrontendUser();
    }

    /**
     * Returns the logged in Contao member (\Contao\MemberModel) if there is a logged in Contao frontend user
     * or null if there is no logged in Contao frontend user.
     *
     * Inside your Twig template:
     * {% set user = get_logged_in_frontend_user() %}
     * Hi, my name is {{ user.firstname }}
     *
     * @see: https://docs.contao.org/dev/framework/asset-management.
     */
    public function getLoggedInFrontendUser(): MemberModel|null
    {
        $user = $this->security->getUser();

        if ($user instanceof FrontendUser) {
            if (null !== ($model = $this->member->findByPk($user->id))) {
                return $model;
            }
        }

        return null;
    }
}
