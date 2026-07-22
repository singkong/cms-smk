<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'menu_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'parent_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'title'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'url'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'icon'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'target'     => ['type' => 'ENUM', 'constraint' => ['_self', '_blank'], 'default' => '_self'],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('menu_id', 'menus', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('parent_id', 'menu_items', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('menu_items');
    }

    public function down()
    {
        $this->forge->dropTable('menu_items');
    }
}
