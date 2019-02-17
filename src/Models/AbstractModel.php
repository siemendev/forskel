<?php
namespace siemendev\ForskelBundle\Models;

abstract class AbstractModel implements ModelInterface
{
    /** @inheritdoc */
    public function getModelTemplate(): string
    {
        // Return an empty string to force template guessing
        return '';
    }
}