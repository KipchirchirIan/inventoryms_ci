<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuperAdminsTbl extends Migration
{
	public function up()
	{
		$this->forge->addField([
		    'sadmin_id' => [
		        'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
		    'first_name' => [
		        'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);
		$this->forge->addPrimaryKey('sadmin_id');
		$this->forge->createTable('tbl_superadmins');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_superadmins');
	}
}
