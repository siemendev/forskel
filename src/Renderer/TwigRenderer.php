<?php
namespace siemendev\ForskelBundle\Renderer;

use Symfony\Component\HttpFoundation\Response;
use siemendev\ForskelBundle\Models\ModelInterface;

class TwigRenderer extends AbstractRenderer
{
    /** @var \Twig_Environment */
    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Build Model
     * Runs twig to compile the template for the given model with the data stored in the model.
     * @param ModelInterface $model
     * @param int $status
     * @param array $headers
     * @return Response|null
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderView(ModelInterface $model): ?string
    {
        $template = $model->getModelTemplate();
        $loader = $this->twig->getLoader();
        $args = ['model' => $model];

        if(empty($template) || !$loader->exists($template)) {

            $guessedTemplate = $this->guessTemplate($model);

            if(!empty($guessedTemplate) && $loader->exists($guessedTemplate)) {
                $template = $guessedTemplate;
            } else {
                $template = '@Forskel/default.html.twig';
                $args['class'] = (new \ReflectionObject($model))->getName();
                $args['dump'] = print_r($model, true);
            }
        }

        return $this->twig->render($template, $args);
    }

    /**
     * Twig environment getter
     * @return \Twig_Environment
     */
    public function getTwig(): \Twig_Environment
    {
        return $this->twig;
    }
}