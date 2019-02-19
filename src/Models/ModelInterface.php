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
 * Interface ModelInterface
 *
 * @package siemendev\ForskelBundle\Models
 */
interface ModelInterface
{
    /**
     * Template getter
     * Returns the template name in case the template can not be matched by the template guessing algorithm.
     *
     * @return string
     */
    public function getModelTemplate(): string;
}
