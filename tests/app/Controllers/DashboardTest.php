<?php

namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\Fabricator;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Models\EmployeeFabricator;

class DashboardTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndex()
    {
        $result = $this->call('get', '/');

        $result->assertRedirectTo('employee/login');
        $result->assertOK();
    }
}
