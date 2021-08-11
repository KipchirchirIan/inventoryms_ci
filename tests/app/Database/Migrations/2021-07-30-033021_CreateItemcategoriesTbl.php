<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemcategoriesTbl extends Migration
{
	public function up()
	{
	    $this->forge->addField([
	        'category_id' => [
	            'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'category_description' => [
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
	    $this->forge->addPrimaryKey('category_id');
	    $this->forge->addForeignKey('added_by', 'tbl_admins', 'admin_id');
	    $this->forge->createTable('tbl_item_categories');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_item_categories');
	}
}
