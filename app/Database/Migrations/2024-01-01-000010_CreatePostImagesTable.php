<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostImagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'post_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'image'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'caption'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('post_id', 'posts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('post_images');
    }

    public function down()
    {
        $this->forge->dropTable('post_images');
    }
}
