<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DbMigration extends Migration
{
    public function up()
    {
        /**
         * Super Admins
         */
        $this->forge->addField([
            'sadmin_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'first_name'    => ['type' => 'VARCHAR', 'constraint' => 50],
            'last_name'     => ['type' => 'VARCHAR', 'constraint' => 50],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
            'deleted_at'    => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('sadmin_id', true);
        $this->forge->addUniqueKey('email');

        $this->forge->createTable('superadmins', true);

        /**
         * Admins
         */
        $this->forge->addField([
            'admin_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'first_name'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'last_name'     => ['type' => 'VARCHAR', 'constraint' => 50,],
            'position'      => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
            'deleted_at'    => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('admin_id', true);
        $this->forge->addUniqueKey('email');

        $this->forge->createTable('admins', true);

        /**
         * Employees
         */
        $this->forge->addField([
            'emp_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'first_name'    => ['type' => 'VARCHAR', 'constraint' => 50],
            'last_name'     => ['type' => 'VARCHAR', 'constraint' => 50],
            'position'      => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'added_by'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
            'deleted_at'    => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('emp_id', true);
        $this->forge->addKey('added_by');
        $this->forge->addForeignKey('added_by', 'admins', 'admin_id');

        $this->forge->createTable('employees', true);

        /**
         * Item Categories
         */
        $this->forge->addField([
            'category_id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_name'         => ['type' => 'VARCHAR', 'constraint' => 50],
            'category_description'  => ['type' => 'TEXT', 'null' => true],
            'position'              => ['type' => 'INT', 'constraint' => 11],
            'added_by'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at'            => ['type' => 'datetime', 'null' => true],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('category_id', true);
        $this->forge->addForeignKey('added_by', 'admins', 'admin_id');

        $this->forge->createTable('item_categories', true);

        /**
         * Unit of Measurements(UOMs)
         */
        $this->forge->addField([
            'uom_id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'uom_short'         => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'uom_full'          => ['type' => 'VARCHAR', 'constraint' => 50],
            'uom_description'   => ['type' => 'TEXT', 'null' => true],
            'added_by'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('uom_id', true);
        $this->forge->addForeignKey('added_by', 'admins', 'admin_id');

        $this->forge->createTable('uoms');

        /**
         * Items
         */
        $this->forge->addField([
            'item_id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'item_name'         => ['type' => 'VARCHAR', 'constraint' => 100],
            'item_description'  => ['type' => 'TEXT', 'null' => true],
            'quantity'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'uom_id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'category_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'note'              => ['type' => 'TEXT', 'null' => true],
            'added_by'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'last_modified_by'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('item_id', true);
        $this->forge->addForeignKey('uom_id', 'uoms', 'uom_id');
        $this->forge->addForeignKey('category_id', 'item_categories', 'category_id');

        $this->forge->createTable('items', true);

        /**
         * Items History
         */
        $this->forge->addField([
            'item_history_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'item_id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'check_in'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'check_out'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'checked_by'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
            'deleted_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('item_history_id', true);
        $this->forge->addForeignKey('item_id', 'items', 'item_id');
        $this->forge->addKey('checked_by');

        $this->forge->createTable('items_history', true);

    }

    public function down()
    {
        $this->forge->dropTable('superadmins', true);
        $this->forge->dropTable('admins', true);
        $this->forge->dropTable('employees', true);
        $this->forge->dropTable('item_categories', true);
        $this->forge->dropTable('items', true);
        $this->forge->dropTable('items_history', true);
        $this->forge->dropTable('uoms', true);
    }
}
