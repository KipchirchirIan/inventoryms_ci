<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTablesModQuantityCols extends Migration
{
    public function up()
    {
        // Modify items quantity column type - INT --> DECIMAL
        $fields = [
            'quantity' => [
                'type'       => 'decimal',
                'constraint' => '5,2',
            ],
        ];

        $this->forge->modifyColumn('items', $fields);

        // Modify items history check in, check out column type - INT --> DECIMAL
        $fields = [
            'check_in' => [
                'type'       => 'decimal',
                'constraint' => '5,2',
            ],
            'check_out' => [
                'type'       => 'decimal',
                'constraint' => '5,2',
            ]
        ];

        $this->forge->modifyColumn('items_history', $fields);
    }

    public function down()
    {
        //
    }
}
