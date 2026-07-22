<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlbumsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'cover'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'type'        => ['type' => 'ENUM', 'constraint' => ['photo', 'video'], 'default' => 'photo'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('albums');
    }

    public function down()
    {
        $this->forge->dropTable('albums');
    }
}
