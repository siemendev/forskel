<?php
namespace siemendev\ForskelBundle\Renderer;

use siemendev\ForskelBundle\Models\ModelInterface;

interface RendererInterface
{
    /**
     * Build Model
     * Runs a templating engine to compile the template for the given model with the data stored in the model.
     * @param ModelInterface $model
     * @return string|null
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderModel(ModelInterface $model): ?string;

    /**
     * Guess template
     * Tries to guess the template name by the models namespace.
     * @param ModelInterface $model
     * @return string|null
     */
    public function guessTemplate(ModelInterface $model): ?string;
}