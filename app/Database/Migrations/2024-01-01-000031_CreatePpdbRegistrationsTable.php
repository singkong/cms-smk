<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePpdbRegistrationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'ppdb_setting_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'no_registrasi'   => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'nama'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'nik'             => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'tempat_lahir'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'tanggal_lahir'   => ['type' => 'DATE', 'null' => true],
            'jk'              => ['type' => 'ENUM', 'constraint' => ['L', 'P'], 'default' => 'L'],
            'alamat'          => ['type' => 'TEXT', 'null' => true],
            'telepon'         => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email'           => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'asal_sekolah'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'jurusan_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'status'          => ['type' => 'ENUM', 'constraint' => ['pending', 'diterima', 'ditolak', 'cadangan'], 'default' => 'pending'],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ppdb_setting_id', 'ppdb_settings', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jurusan_id', 'jurusans', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('ppdb_registrations');
    }

    public function down()
    {
        $this->forge->dropTable('ppdb_registrations');
    }
}
