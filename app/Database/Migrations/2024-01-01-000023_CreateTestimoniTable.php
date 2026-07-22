<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTestimoniTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'foto'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'jurusan'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'angkatan'   => ['type' => 'YEAR', 'null' => true],
            'pesan'      => ['type' => 'TEXT'],
            'is_active'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('testimoni');
    }

    public function down()
    {
        $this->forge->dropTable('testimoni');
    }
}
