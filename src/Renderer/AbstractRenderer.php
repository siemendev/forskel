<?php
namespace siemendev\ForskelBundle\Renderer;

use siemendev\ForskelBundle\Models\ModelInterface;

abstract class AbstractRenderer implements RendererInterface
{
    /**
     * Guess template
     * Tries to guess the template name by the models namespace. If the template exists under that name,
     * the guessed template will be used
     * @param ModelInterface $model
     * @return string|null
     */
    public function guessTemplate(ModelInterface $model): ?string
    {
        try {
            $class = (new \ReflectionClass($model));
        } catch (\ReflectionException $e) {
            return '';
        }

        $classShort = $class->getShortName();
        $classFQN = $class->getName();
        $matches = [];

        if(preg_match('/([A-Za-z]+)Bundle\\\Models\\\(.*)\\' . $classShort . '/', $classFQN, $matches)) {

            return '@' . $matches[1] . '/' . str_replace('\\', '/', $matches[2]) . $this->convertClassnameToTemplateName($classShort) . '.html.twig';

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