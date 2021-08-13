<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategorycolItemstbl extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_items', [
            'category_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false,
                'default' => 5,
                'after' => 'uom',
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
