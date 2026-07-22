<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'content'          => ['type' => 'LONGTEXT'],
            'excerpt'          => ['type' => 'TEXT', 'null' => true],
            'image'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'category_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'user_id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'type'             => ['type' => 'ENUM', 'constraint' => ['berita', 'pengumuman', 'agenda', 'prestasi', 'halaman'], 'default' => 'berita'],
            'status'           => ['type' => 'ENUM', 'constraint' => ['draft', 'published', 'trash'], 'default' => 'draft'],
            'is_featured'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'is_headline'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'views'            => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'meta_title'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_description' => ['type' => 'TEXT', 'null' => true],
            'meta_keywords'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'og_image'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'published_at'     => ['type' => 'DATETIME', 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
