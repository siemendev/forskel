<?php
namespace siemendev\ForskelBundle\Renderer;

use Twig\Environment;
use siemendev\ForskelBundle\Models\ModelInterface;

class TwigRenderer extends AbstractRenderer
{
    /** @var Environment */
    protected $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Build Model
     * Runs twig to compile the template for the given model with the data stored in the model.
     * @param ModelInterface $model
     * @return string|null
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function renderModel(ModelInterface $model): ?string
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
}