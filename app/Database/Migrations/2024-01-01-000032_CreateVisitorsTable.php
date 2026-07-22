<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVisitorsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45],
            'country'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'city'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'browser'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'device'     => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'os'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'page'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'referrer'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'user_agent' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('ip_address');
        $this->forge->addKey('created_at');
        $this->forge->createTable('visitors');
    }

    public function down()
    {
        $this->forge->dropTable('visitors');
    }
}
