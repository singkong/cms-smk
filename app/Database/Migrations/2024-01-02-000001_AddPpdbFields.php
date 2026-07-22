<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPpdbFields extends Migration
{
    public function up()
    {
        $fields = [
            'persyaratan'   => ['type' => 'TEXT', 'null' => true, 'after' => 'kontak_info'],
            'jadwal'        => ['type' => 'TEXT', 'null' => true, 'after' => 'persyaratan'],
            'alur'          => ['type' => 'TEXT', 'null' => true, 'after' => 'jadwal'],
            'biaya'         => ['type' => 'TEXT', 'null' => true, 'after' => 'alur'],
            'formulir_link' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'biaya'],
            'kuota'         => ['type' => 'INT', 'constraint' => 11, 'default' => 0, 'after' => 'formulir_link'],
        ];
        $this->forge->addColumn('ppdb_settings', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('ppdb_settings', ['persyaratan', 'jadwal', 'alur', 'biaya', 'formulir_link', 'kuota']);
    }
}
