<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTbl extends Migration
{
	public function up()
	{
	    $this->forge->addField([
	        'item_id' => [
	            'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'item_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'item_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'uom' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
//            'uom_2nd' => [
//                'type' => 'INT',
//                'constraint' => 5,
//                'unsigned' => true,
//                'null' => true,
//            ],
//            'uom_3rd' => [
//                'type' => 'INT',
//                'constraint' => 5,
//                'unsigned' => true,
//                'null' => true,
//            ],
            'note' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'added_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'last_modified_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);
	    $this->forge->addPrimaryKey('item_id');
	    $this->forge->addForeignKey('uom', 'tbl_uoms', 'uom_id');
//        $this->forge->addForeignKey('uom_2nd', 'tbl_uoms', 'uom_id');
//        $this->forge->addForeignKey('uom_3rd', 'tbl_uoms', 'uom_id');
//        $this->forge->addForeignKey('added_by', 'tbl_admins', 'admin_id');
//        $this->forge->addForeignKey('last_modified_by', 'tbl_admins', 'admin_id');
//        $this->forge->addForeignKey('last_modified_by', 'tbl_employees', 'emp_id');
        $this->forge->createTable('tbl_items');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_items');
	}
}
