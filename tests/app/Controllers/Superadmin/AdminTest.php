<?php

namespace App\Controllers\Superadmin;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;

class AdminTest extends CIUnitTestCase
{
    use FeatureTestTrait, DatabaseTestTrait;

    public function testPostStoreLoggedIn()
    {
        $result = $this->withSession([
            'sa_logged_in' => true,
        ])->post('superadmin/admin/store', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@mail.com',
            'password' => '12345688',
        ]);

        $result->assertOK();
    }

    public function testCreateLoggedIn()
    {
        $result = $this->withSession([
            'sa_logged_in' => true,
        ])->call('get', 'superadmin/admin/create');

        $result->assertSee('Add Administrator');
        $result->assertSeeElement('input');
        $result->assertStatus(200);
        $result->assertOK();
    }

    public function testIndex()
    {
        $result = $this->call('get', 'superadmin/admin/index');

        $result->assertRedirectTo('superadmin/login');
        $result->assertStatus(302);
        $result->assertOK();
    }

    public function testIndexLoggedIn()
    {
        $result = $this->withSession([
            'sa_logged_in' => true,
        ])->get('superadmin/admin/index');

        $result->assertSee('All Administrators');
        $result->assertSeeElement('table');
        $result->assertStatus(200);
        $result->assertOK();
    }
}
