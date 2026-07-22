<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePpdbSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tahun_ajaran' => ['type' => 'VARCHAR', 'constraint' => 20],
            'is_open'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'tanggal_buka' => ['type' => 'DATE', 'null' => true],
            'tanggal_tutup' => ['type' => 'DATE', 'null' => true],
            'biaya_pendaftaran' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'null' => true],
            'kontak_info'  => ['type' => 'TEXT', 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ppdb_settings');
    }

    public function down()
    {
        $this->forge->dropTable('ppdb_settings');
    }
}
