<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SuperAdminSeeder extends Seeder
{
	public function run()
	{

		$data = [
		    'first_name' => 'Ian',
            'last_name' => 'Kipchirchir',
            'email' => 'potterke4@gmail.com',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
        ];

        $this->db->table('superadmins')->truncate();
		$this->db->table('superadmins')->insert($data);
	}
}
