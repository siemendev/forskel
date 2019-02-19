<?php
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