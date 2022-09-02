<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alquran extends Migration
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
            'tanggal' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ],
            'bulan' => [
                'type' => 'VARCHAR',
                'constraint' => 2
            ],
            'anggotakelas_id' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 3
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 3
            ],
            'mapel' => [
                'type' => 'VARCHAR',
                'constraint' => 3
            ],
            'kkm' => [
                'type' => 'INT',
                'constraint' => 3
            ],
            'pengajar' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'nilai' => [
                'type' => 'INT',
                'constraint' => 3
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
        $this->forge->createTable('alquran');
    }

    public function down()
    {
        $this->forge->dropTable('alquran');
    }
}
