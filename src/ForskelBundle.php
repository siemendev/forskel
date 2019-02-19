<?php

/**
 * This file is part of the siemendev/forskel package.
 *
 * (c) Patrick Siemen <post@patrick-siemen.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace siemendev\ForskelBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use siemendev\ForskelBundle\DependencyInjection\ForskelBundleExtension;

/**
 * Class ForskelBundle
 *
 * @package siemendev\ForskelBundle
 */
class ForskelBundle extends Bundle
{
    /**
     * Container extension getter
     * Returns the container extension for the bundle
     *
     * @return ForskelBundleExtension
     */
    public function getContainerExtension()
    {
        return new ForskelBundleExtension();
    }
}
