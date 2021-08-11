<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedatCols extends Migration
{
	public function up()
	{
		$this->forge->addColumn('tbl_admins', [
		    'deleted_at' => [
		        'type' => 'timestamp',
                'null' => true,
                'after' => 'updated_at',
            ],
        ]);

        $this->forge->addColumn('tbl_employees', [
            'deleted_at' => [
                'type' => 'timestamp',
                'null' => true,
                'after' => 'updated_at',
            ],
        ]);
	}

	public function down()
	{
		//
	}
}
