<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsHistoryTbl extends Migration
{
	public function up()
	{
		$this->forge->addField([
		    'item_history_id' => [
		        'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'item_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'check_in' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'check_out' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'checked_by' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at timestamp default current_timestamp',
        ]);

		$this->forge->addPrimaryKey('item_history_id');
		$this->forge->addForeignKey('item_id', 'tbl_items', 'item_id');
		$this->forge->addKey('checked_by');
		$this->forge->createTable('tbl_items_history');
	}

	public function down()
	{
		$this->forge->dropTable('tbl_items_history');
	}
}
