<?php
namespace siemendev\ForskelBundle\Twig;

use siemendev\ForskelBundle\Renderer\TwigRenderer;
use Twig\Extension\RuntimeExtensionInterface;
use siemendev\ForskelBundle\Models\ModelInterface;

class ForskelRuntime implements RuntimeExtensionInterface
{
    /** @var TwigRenderer */
    protected $forskel;

    public function __construct(TwigRenderer $forskel)
    {
        $this->forskel = $forskel;
    }

    public function render(ModelInterface $model): string
    {
        return $this->forskel->renderModel($model);
    }
}
