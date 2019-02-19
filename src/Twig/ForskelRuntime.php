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

use siemendev\ForskelBundle\Renderer\TwigRenderer;
use Twig\Extension\RuntimeExtensionInterface;
use siemendev\ForskelBundle\Models\ModelInterface;

/**
 * Class ForskelRuntime
 *
 * @package siemendev\ForskelBundle\Twig
 */
class ForskelRuntime implements RuntimeExtensionInterface
{
    /**
     * @var TwigRenderer
     */
    protected $forskel;

    /**
     * ForskelRuntime constructor.
     *
     * @param TwigRenderer $forskel
     */
    public function __construct(TwigRenderer $forskel)
    {
        $this->forskel = $forskel;
    }

    /**
     * Renderer
     * Proxy method to access the renderView method of forskels TwigRenderer.
     *
     * @param  ModelInterface $model
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(ModelInterface $model): string
    {
        return $this->forskel->renderView($model);
    }
}
