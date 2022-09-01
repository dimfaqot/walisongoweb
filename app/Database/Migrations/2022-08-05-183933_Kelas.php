<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'subs' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'angkatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'wali_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tempat' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kepala' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
