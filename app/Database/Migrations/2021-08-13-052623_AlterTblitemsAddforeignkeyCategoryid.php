<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTblitemsAddforeignkeyCategoryid extends Migration
{
	public function up()
	{
        // $this->forge->addForeignKey('category_id', 'tbl_item_categories', 'category_id');
	}

	public function down()
	{
		//
	}
}
