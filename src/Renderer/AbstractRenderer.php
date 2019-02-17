<?php
namespace siemendev\ForskelBundle\Renderer;

use siemendev\ForskelBundle\Models\ModelInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractRenderer implements RendererInterface
{
    /** @var ?string */
    private $templatePath = '';

    public function setTemplatePath(?string $path): void
    {
        $this->templatePath = $path;
    }

    public function getTemplatePath(): ?string
    {
        return $this->templatePath;
    }

    public function render(ModelInterface $model, $status = 200, $headers = []): Response
    {
        return new Response($this->renderView($model), $status, $headers);
    }

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

            return '@' . $matches[1] . '/' . (!empty($this->getTemplatePath()) ? $this->getTemplatePath() . '/' : '') . str_replace('\\', '/', $matches[2]) . $this->convertClassnameToTemplateName($classShort) . '.html.twig';

        }

        return '';
    }

    private function convertClassnameToTemplateName(string $classname): string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $classname, $matches);

        foreach ($matches[0] as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('-', $matches[0]);
    }
}