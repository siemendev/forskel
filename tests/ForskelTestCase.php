<?php

/**
 * This file is part of the siemendev/forskel package.
 *
 * (c) Patrick Siemen <post@patrick-siemen.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace siemendev\ForskelBundle\Tests;

use siemendev\ForskelBundle\Models\AbstractModel;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

abstract class ForskelTestCase extends TestCase
{
    public function mockModel()
    {
        $model = new TestModel();

        $model->name = 'Patrick Siemen';
        $model->email = 'post@patrick-siemen.de';

        return $model;
    }
}

class TestModel extends AbstractModel
{
    public $name;
    public $email;
}