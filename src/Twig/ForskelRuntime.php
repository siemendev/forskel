<?php
namespace siemendev\ForskelBundle\Twig;

use Twig\Extension\RuntimeExtensionInterface;
use siemendev\ForskelBundle\Services\Renderer;
use siemendev\ForskelBundle\Models\ModelInterface;

class ForskelRuntime implements RuntimeExtensionInterface
{
    /** @var Renderer */
    protected $forskel;

    public function __construct(Renderer $forskel)
    {
        $this->forskel = $forskel;
    }

    public function render(ModelInterface $model): string
    {
        return $this->forskel->renderModel($model);
    }
}
