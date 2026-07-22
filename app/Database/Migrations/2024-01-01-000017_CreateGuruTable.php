<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGuruTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nip'         => ['type' => 'VARCHAR', 'constraint' => 30, 'unique' => true],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'foto'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'jabatan'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'bidang'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pendidikan'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'alamat'      => ['type' => 'TEXT', 'null' => true],
            'telepon'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'facebook'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'instagram'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order'  => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'is_active'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('guru');
    }

    public function down()
    {
        $this->forge->dropTable('guru');
    }
}
