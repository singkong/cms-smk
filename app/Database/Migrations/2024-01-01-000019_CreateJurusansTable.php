<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJurusansTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'           => ['type' => 'VARCHAR', 'constraint' => 255],
            'singkatan'      => ['type' => 'VARCHAR', 'constraint' => 10],
            'deskripsi'      => ['type' => 'TEXT', 'null' => true],
            'gambar'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'visi'           => ['type' => 'TEXT', 'null' => true],
            'misi'           => ['type' => 'TEXT', 'null' => true],
            'akreditasi'     => ['type' => 'VARCHAR', 'constraint' => 5, 'null' => true],
            'kepala_jurusan' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'prospek_kerja'  => ['type' => 'TEXT', 'null' => true],
            'kurikulum'      => ['type' => 'TEXT', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jurusans');
    }

    public function down()
    {
        $this->forge->dropTable('jurusans');
    }
}
