<?php
namespace siemendev\ForskelBundle\Twig;

use Twig\Extension\RuntimeExtensionInterface;
use siemendev\ForskelBundle\Services\Builder;
use siemendev\ForskelBundle\Models\ModelInterface;

class ForskelRuntime implements RuntimeExtensionInterface
{
    /** @var Builder */
    protected $forskel;

    public function __construct(Builder $forskel)
    {
        $this->forskel = $forskel;
    }

    public function render(ModelInterface $model): string
    {
        return $this->forskel->buildModel($model);
    }
}
