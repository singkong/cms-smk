<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlumniTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'foto'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'angkatan'   => ['type' => 'YEAR', 'null' => true],
            'jurusan'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'pekerjaan'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'perusahaan' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('alumni');
    }

    public function down()
    {
        $this->forge->dropTable('alumni');
    }
}
