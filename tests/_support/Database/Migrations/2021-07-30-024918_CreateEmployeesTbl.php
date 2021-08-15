<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeesTbl extends Migration
{
	public function up()
	{
		$this->forge->addField([
		    'emp_id' => [
		        'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
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
            'added_by' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);
		$this->forge->addPrimaryKey('emp_id');
		$this->forge->addForeignKey('added_by', 'tbl_admins', 'admin_id');
		$this->forge->addKey('added_by');
		$this->forge->createTable('tbl_employees');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_employees');
	}
}
