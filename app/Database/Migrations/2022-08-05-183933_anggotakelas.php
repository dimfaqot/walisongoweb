<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Anggotakelas extends Migration
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
            'tahun' => [
                'type' => 'INT',
                'constraint' => 4
            ],
            'subs' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'angkatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'wali_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'tempat' => [
                'type' => 'VAECHAR',
                'constraint' => 128
            ],
            'kepala' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'cabang' => [
                'type' => 'VARCHAR',
                'constraint' => 128
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
        $this->forge->createTable('anggotakelas');
    }

    public function down()
    {
        $this->forge->dropTable('anggotakelas');
    }
}
