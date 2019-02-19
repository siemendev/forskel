<?php

/**
 * This file is part of the siemendev/forskel package.
 *
 * (c) Patrick Siemen <post@patrick-siemen.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace siemendev\ForskelBundle\Models;

/**
 * Class AbstractModel
 *
 * @package siemendev\ForskelBundle\Models
 */
abstract class AbstractModel implements ModelInterface
{
    public function getModelTemplate(): string
    {
        // Return an empty string to force template guessing
        return '';
    }
}
