<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUomTbl extends Migration
{
	public function up()
	{
		$this->forge->addField([
		    'uom_id' => [
		        'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'uom_short' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'uom_full' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'uom_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'added_by' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);
		$this->forge->addPrimaryKey('uom_id');
		$this->forge->addForeignKey('added_by', 'tbl_admins', 'admin_id');
		$this->forge->createTable('tbl_uoms');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_uoms');
	}
}
