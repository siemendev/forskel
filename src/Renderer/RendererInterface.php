<?php
namespace siemendev\ForskelBundle\Renderer;

use siemendev\ForskelBundle\Models\ModelInterface;
use Symfony\Component\HttpFoundation\Response;

interface RendererInterface
{
    /**
     * Render a model
     * Renders the markup for a model and returns a fully qualified http response object.
     * @param ModelInterface $model
     * @param int $status
     * @param array $headers
     * @return Response
     */
    public function render(ModelInterface $model, $status = 200, $headers = []): Response;

    /**
     * Build Model
     * Runs a templating engine to compile the template for the given model with the data stored in the model.
     * @param ModelInterface $model
     * @return string|null
     */
    public function renderView(ModelInterface $model): ?string;

    /**
     * Guess template
     * Tries to guess the template name by the models namespace.
     * @param ModelInterface $model
     * @return string|null
     */
    public function guessTemplate(ModelInterface $model): ?string;
}