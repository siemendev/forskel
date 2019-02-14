<?php
namespace siemendev\ForskelBundle\Services;

use Twig\Environment;
use siemendev\ForskelBundle\Models\ModelInterface;

class Builder
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
    public function buildModel(ModelInterface $model): ?string
    {
        $template = $model->getModelTemplate();
        $args = ['model' => $model];

        if(empty($template) || !$this->twig->getLoader()->exists($template)) {

            $guessedTemplate = $this->guessTemplate($model);

            if(!empty($guessedTemplate)) {
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
     * Guess template
     * Tries to guess the template name by the models namespace. If the template exists under that name,
     * the guessed template will be used
     * @param ModelInterface $model
     * @return string|null
     */
    protected function guessTemplate(ModelInterface $model): ?string
    {
        try {
            $class = (new \ReflectionClass($model));
        } catch (\ReflectionException $e) {
            return '';
        }

        $classShort = $class->getShortName();
        $classFQN = $class->getName();
        $matches = [];

        if(preg_match('/([A-Za-z]+)Bundle\\\models\\\(.*)\\' . $classShort . '/', $classFQN, $matches)) {

            $template = '@' . $matches[1] . '/' . str_replace('\\', '/', $matches[2]) . $this->convertClassnameToTemplateName($classShort) . '.html.twig';

            if($this->twig->getLoader()->exists($template)) {
                return $template;
            }
        }

        return '';
    }

    /**
     * Class name string converter
     * Converts the classname (camel case) to a template naming format.
     * Example:
     * MyFancyComponent => my-fancy-component
     *
     * @param string $classname
     * @return string
     */
    private function convertClassnameToTemplateName(string $classname): string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $classname, $matches);

        foreach ($matches[0] as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('-', $matches[0]);
    }
}