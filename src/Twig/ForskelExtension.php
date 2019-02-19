<?php

/**
 * This file is part of the siemendev/forskel package.
 *
 * (c) Patrick Siemen <post@patrick-siemen.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace siemendev\ForskelBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class ForskelExtension
 *
 * @package siemendev\ForskelBundle\Twig
 */
class ForskelExtension extends AbstractExtension
{
    /**
     * Functions getter
     * Returns all twig functions implemented by this package.
     *
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('forskel_render', [ForskelRuntime::class, 'render'], ['is_safe' => ['html']]),
        ];
    }
}
