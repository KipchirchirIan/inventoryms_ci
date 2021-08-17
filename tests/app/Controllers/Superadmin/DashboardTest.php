<?php

namespace App\Controllers\Superadmin;

use App\Models\SuperAdminModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Models\SuperAdminFabricator;

class DashboardTest extends CIUnitTestCase
{
    use FeatureTestTrait, DatabaseTestTrait;

    public function testLogout()
    {
        $result = $this->call('get', 'superadmin/logout');

        $result->assertSessionMissing('ims_email');
        $result->assertOK();
    }

    public function testLogin()
    {
        $result = $this->call('get', 'superadmin/login');

        $result->assertOK();
    }

    public function testIndex()
    {
        $result = $this->call('get', 'superadmin/dashboard');

        $result->assertRedirectTo('superadmin/login');
        $result->assertOK();
    }

    public function testIndexLogIn()
    {
        $result = $this->post( 'superadmin/login', [
            'email' => 'potterke4@gmail.com',
            'password' => '1234',
        ]);

        $result->assertOK();
    }

    public function testIndexLoggedIn()
    {
        $fabricator = new Fabricator(SuperAdminFabricator::class);
        $user = $fabricator->make(1);

        $result = $this->withSession([
            'ims_email' => $user[0]['email'],
            'ims_name' => $user[0]['first_name'],
            'sa_logged_in' => true,
        ])->get('superadmin/dashboard');

        $result->assertSee('Welcome');
        $result->assertSee($user[0]['first_name']);
        $result->assertSessionHas('sa_logged_in', true);
        $result->assertSessionHas('ims_email', $user[0]['email']);
        $result->assertStatus(200);
        $result->assertOK();
    }
}