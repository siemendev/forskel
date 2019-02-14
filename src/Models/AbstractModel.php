<?php
namespace siemendev\ForskelBundle\Models;

abstract class AbstractModel implements ModelInterface
{

    public function getModelTemplate(): string
    {
        // Return an empty string to force template guessing
        return '';
    }
}