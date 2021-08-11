<?php

namespace App\Controllers;

use App\Controllers\Dashboard;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\FeatureTestTrait;


class SuperadminTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndex()
    {
        $result = $this->call('get', 'superadmin/index');

        $result->assertRedirectTo('superadmin/login');
        $result->assertOK();
    }

    public function testLogin()
    {
        $result = $this->call('get', 'superadmin/login');

        $result->assertOK();
    }

    public function testIndexLoggedIn()
    {
        $values = [
            'ims_email' => 'potterke4@gmail.com',
            'ims_said' => '1'
        ];

        $result = $this->withSession($values)->get('superadmin/index');

        $result->assertSee('Welcome, potterke4@gmail.com');
        $result->assertSessionHas('ims_email', 'potterke4@gmail.com');
        $result->assertOK();
    }

    public function testLoginPost()
    {
        $result = $this->call('post', 'superadmin/login', [
            'email' => 'potterke4@gmail.com',
            'password' => '1234',
        ]);

        $result->assertOK();
    }

    public function testLogout()
    {
        $result = $this->call('get', 'superadmin/logout');

        $result->assertSessionMissing('ims_email');
        $result->assertOK();
    }
}
