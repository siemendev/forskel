<?php
namespace siemendev\ForskelBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ForskelExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('forskel_render', [ForskelRuntime::class, 'render'], ['is_safe' => ['html']]),
        ];
    }
}
