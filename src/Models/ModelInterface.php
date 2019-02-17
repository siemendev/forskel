<?php
namespace siemendev\ForskelBundle\Models;

interface ModelInterface
{
    /**
     * Template getter
     * Returns the template name in case the template can not be matched by the template guessing algorithm.
     * @return string
     */
    public function getModelTemplate(): string;
}